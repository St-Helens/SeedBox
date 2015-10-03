require(rvest)
require(data.table)

setwd("~/Documents/DG")
DG_base_url <- 'http://www.desiringgod.org'
DG_topic_url <- paste0(DG_base_url,'/messages/by-topic')
DG_html_data <- read_html(DG_topic_url)
DG_topics_info <- DG_html_data %>% 
  html_nodes('.link-list a')
  

DG_topics_text <- DG_topics_info %>% html_text()

DG_topics_links <- paste0(DG_base_url,DG_topics_info %>% html_attr("href"))

DG_refs <- lapply(DG_topics_links,function(y){
  read_html(y) %>% 
    html_nodes('.scripture-reference') %>% 
    html_text() %>% 
    gsub("\n","",.)
})
names(DG_refs) <- DG_topics_text
saveRDS(DG_refs,"DG_refs.rds")


setwd("~/Documents/TGC/")
TGC_base_url <- 'http://resources.thegospelcoalition.org'

TGC_topic_url <- paste0(TGC_base_url,'/library/topic_index')
TGC_html_data <- read_html(TGC_topic_url)
TGC_broad_topics <- TGC_html_data %>% 
  html_nodes('.mini-4 h3') %>% 
  html_text()
TGC_topics_info <- TGC_html_data %>% 
  html_nodes('.mini-4 a')
TGC_topics_text <- TGC_topics_info %>% html_text()

TGC_topics_links_hrefs <- TGC_topics_info %>% 
  html_attr("href") 

href_sections <- TGC_topics_links_hrefs %>% 
  gsub("/library?f%5Btopic%5D%5B%5D=","",.,fixed=TRUE) %>% 
  gsub("+"," ",.,fixed=TRUE) %>% 
  lapply(.,function(y){unlist(strsplit(y,'%3A%3A'))})
  
TGC_topics_links <- paste0(TGC_base_url,TGC_topics_links_hrefs)

# if the below section fails for some reason just keep re-running until it all is finished...
TGC_refs <- lapply(seq_along(TGC_topics_links),function(y1){
  print(y1)
  if(file.exists(paste0(paste0(gsub(" ","_",href_sections[[y1]]),collapse="."),".rds"))){
    mm <- readRDS(paste0(paste0(gsub(" ","_",href_sections[[y1]]),collapse="."),".rds"))
    return(mm)
  } else {
    y <- TGC_topics_links[y1]
    print(y)
    tmp <- read_html(y) 
    
    if(length(tmp)!=0){
      mm <- tmp %>% 
        html_nodes('.no-rt') %>% 
        html_text() %>% 
        sapply(.,function(z){
          if(grepl('|',z)){
            data.table::last(strsplit(z,'| ',fixed=TRUE)[[1]])
          } else {
            NA
          }
        },USE.NAMES =FALSE)
    } else {
      mm <- NA
    }
    
    # check if there are more than 20
    more_than_20 <- tmp %>% 
      html_nodes('.blacklight_pagination-pages') %>% 
      html_text() %>% 
      grepl('Next',.)
    
    if(more_than_20){
      next_sets <- tmp %>% 
        html_nodes('.pagination a') %>% 
        html_attr("href") %>% 
        paste0(TGC_base_url,.)
      if(length(next_sets)>10){
        # get the last page
        pp <- last(next_sets)
        pp_n <- nchar(pp)
        substr(pp,1,pp_n-2)
        next_sets <- paste0(substr(pp,1,pp_n-2),
                            seq(as.integer(substr(pp,pp_n-1,pp_n)))[-1])
      }
      
      
      mm <- c(mm,unlist(lapply(next_sets,function(x){
        print(x)
        tmp1 <- read_html(x)%>% 
          html_nodes('.no-rt') %>% 
          html_text() %>% 
          sapply(.,function(z){
            if(grepl('|',z)){
              data.table::last(strsplit(z,'| ',fixed=TRUE)[[1]])
            } else {
              NA
            }
          },USE.NAMES =FALSE)
        return(tmp1)
      })))
    } else {}
    saveRDS(mm,file=paste0(paste0(gsub(" ","_",href_sections[[y1]]),collapse="."),".rds"))
    return(mm)
  }
})

# get book names
TGC_book_url <- paste0(TGC_base_url,'/library/scripture_index')
bible_book_names <- read_html(TGC_book_url) %>% 
  html_nodes('.index-page li') %>% 
  html_text() %>% 
  sapply(.,function(y){substr(y,1,nchar(y)-2)},USE.NAMES = FALSE)

# Clean up TGC_refs
TGC_refs2 <- lapply(seq_along(TGC_refs),function(y0){
  print(y0)
  y <- unlist(TGC_refs[[y0]])
  if(length(y)==0){
    return(y)
  } else {
    # remove anything that has a month name in it...
    y2 <- y[!sapply(y,function(y1){any(sapply(month.name,function(x){grepl(x,y1)}))})]
    if(length(y2)==0){
      return(y2)
    } else{
      # filter out ones that don't have a bible book name in it...
      y3 <- y2[sapply(y2,function(y3){any(sapply(bible_book_names,function(x){grepl(x,y3)}))})]
      return(y3)
    }
  }
})

names(TGC_refs2) <- sapply(seq_along(href_sections),function(y1){paste0(gsub(" ","_",href_sections[[y1]]),collapse=".")})


# Get book chapter numbers
BG_base_url <- 'https://www.biblegateway.com'
book_list_info_url <- paste0(BG_base_url,'/versions/English-Standard-Version-ESV-Bible/#booklist')
book_list_info <- read_html(book_list_info_url) %>% 
  html_nodes('.collapse')

book_num_chapts <- sapply(seq(2,132,by=2),function(y){
  html_nodes(book_list_info[y],"a") %>% 
    html_text() %>% 
    last() %>% 
    as.integer()
})


bible_data <- data.table(book=rep(bible_book_names,times=book_num_chapts),
                                  chapter=unlist(lapply(book_num_chapts,function(y){seq(y)}))
                                        )
get_num_verses <- function(book,chapter){
  url <- paste0(BG_base_url,'/passage/?search=',gsub(" ","+",book),'+',chapter,'&version=ESV')
  print(url)
  read_html(url) %>% 
    html_nodes('.versenum') %>% 
    html_text() %>% 
    as.integer() %>% 
    sort() %>%
    last()
}
bible_data[,num_verses:=sapply(seq(nrow(bible_data)),function(y){
  print(y)
  get_num_verses(bible_data$book[y],bible_data$chapter[y])})]

setnames(bible_data,'num_verses','total_chapt_verses')

bible_data <- data.table::rbindlist(lapply(seq(nrow(bible_data)),function(y){
  tmp <- bible_data[y,]
  tmp <- tmp[rep(1,tmp[,total_chapt_verses])]
  tmp[,verse:=seq(tmp[1,total_chapt_verses])]
}))
bible_data[,verse_id:=seq(nrow(bible_data))]
setkey(bible_data,book,chapter,verse_id)
saveRDS(bible_data,"~/Documents/bible_data.rds")

bible_data_chapt <- unique(bible_data[,c('book','chapter'),with=FALSE],by=c('book','chapter'))
bible_data_chapt[,chapt_id:=seq(nrow(bible_data_chapt))]
setkey(bible_data_chapt,book,chapter)
num_chapt_summary <- bible_data_chapt[,list(num_chapt=.N),by=book]

bible_data_book <- unique(bible_data[,c('book'),with=FALSE],by='book')
bible_data_book[,book_id:=seq(nrow(bible_data_book))]
setkey(bible_data_book,book)
setkey(bible_data,book)
bible_data <- bible_data_book[bible_data,]

setkey(bible_data,book,chapter)
bible_data <- bible_data_chapt[bible_data,]

setkey(bible_data,book_id,chapt_id,verse_id)

#bible_data[,total_chapt_verses:=NULL]


create_ref_dt <- function(dt){
  rbindlist(lapply(seq_along(dt),function(y){
    y1 <- dt[[y]]
    topic <- names(dt)[y]
    num_rows <- length(y1)
    if(num_rows==0){
      data.table(
        topic=topic,
        ref=NA)
    } else {
      data.table(
        topic=rep(topic,num_rows),
        ref=y1)
    }
  }))
}

DG_refs_dt <- create_ref_dt(DG_refs)
nrow(DG_refs_dt)
TGC_refs_dt <- create_ref_dt(TGC_refs2)
nrow(TGC_refs_dt)

# expand multiple references for DG_refs_dt
mm <- DG_refs_dt[grepl("and",DG_refs_dt$ref),]
DG_refs_dt <- rbindlist(
  list(DG_refs_dt[!grepl("and",DG_refs_dt$ref),],
       rbindlist(lapply(seq(nrow(mm)),function(y){
         tmp <- mm[y,]
         p <- strsplit(tmp$ref," and ")[[1]]
         out <- tmp[rep(1,length(p)),]
         out[,ref:=p]
         out
         })
         )
       )
  )
nrow(DG_refs_dt)

# expand multiple references for TGC_refs_dt
mm <- TGC_refs_dt[grepl("; ",TGC_refs_dt$ref) | grepl(", ",TGC_refs_dt$ref),]
TGC_refs_dt <- rbindlist(
  list(TGC_refs_dt[!(grepl("; ",TGC_refs_dt$ref) | grepl(", ",TGC_refs_dt$ref)),],
       rbindlist(lapply(seq(nrow(mm)),function(y){
         tmp <- mm[y,]
         # split by the semi-colon
         p <- strsplit(tmp$ref,"; ")[[1]]
         # check if any of the split references have a comma to represent a further split reference
         if(any(grepl(",",p))){
           p_w_comma <- p[grepl(',',p)]
           new_p_w_comma <- unlist(lapply(p_w_comma,function(z){
             book_ref <- bible_book_names[sapply(bible_book_names,function(y1){grepl(y1,z)})]
             # check if a book reference is found
             if(length(book_ref)==0){
               # if no book reference then use the previous book reference
               book_ref <- bible_book_names[sapply(bible_book_names,function(y1){grepl(y1,p[grep(',',p)-1])})]
               z1 <- strsplit(z,",")[[1]]
               if(grepl(":",z1[1]) & !grepl(":",z1[2])){
                 # add the chapters to the references without them, by using the onest that have them
                 z1[-1] <- paste0(strsplit(z1[1],":")[[1]][1],":",gsub(" ","",z1[-1]))
                 z1 <- paste(book_ref,z1)
               } else if(grepl(":",z1[1]) & grepl(":",z1[2])){
                 # if chapter is given in the second refeence, add just the book name
                 z1[!grepl(book_ref,z1)] <- paste0(book_ref,z1[!grepl(book_ref,z1)])
               }
             } else{
               z1 <- strsplit(z,",")[[1]]
               if(grepl(":",z1[1]) & !grepl(":",z1[2])){
                 # add the chapters to the references without them, by using the onest that have them
                 z1[-1] <- paste0(strsplit(z1[1],":")[[1]][1],":",gsub(" ","",z1[-1]))
               } else if(grepl(":",z1[1]) & grepl(":",z1[2])){
                 # if chapter is given in the second reference, add just the book name
                 z1[!grepl(book_ref,z1)] <- paste0(book_ref,z1[!grepl(book_ref,z1)])
               } else if(!grepl(":",z1[1]) & grepl(":",z1[2])){
                 z1[!grepl(book_ref,z1)] <- paste0(book_ref,z1[!grepl(book_ref,z1)])
               }
             }
             z1
           }))
           # get the refernces that had no commas
           p_wo_comma <- p[!grepl(',',p)]
           # combine the no comma references with the new split up comma references
           p <- c(p_wo_comma,new_p_w_comma)
         } else {}
         out <- tmp[rep(1,length(p)),]
         out[,ref:=p]
         out
       })
       )
  )
)
nrow(TGC_refs_dt)

bible_book_names_v2 <- c(bible_book_names,"Psalm")

get_start_and_end_ref_verse_id_v2 <- function(y){
  if(is.na(y)){
    ref_book <- NA
    first_chapt <- NA
    first_vs <- NA
    end_chapt <- NA
    end_vs <- NA
  } else {
    ref_book <- last(bible_book_names_v2[sapply(bible_book_names_v2,function(x){grepl(x,y)})])
    if(length(ref_book)!=1){
      # use approximate search for correct book name
      ref_book <- last(bible_book_names_v2[sapply(bible_book_names_v2,function(x){agrepl(x,y)})])
    } else {}
    if(ref_book=='Psalm'){
      ref_book <- "Psalms"
    }
    x <- as.integer(strsplit(y, "[^0-9]+")[[1]][-1])
    if(length(x)==0){
      # Just book given
      first_chapt <- 1
      first_vs <- 1
      last_chapt <- num_chapt_summary[.(ref_book),num_chapt]
      last_vs <- bible_data[book==ref_book & chapter==num_chapt_summary[.(ref_book),num_chapt],total_chapt_verses][1]
    } else if(length(x)==1){
      # just chapter given
      first_chapt <- x[1]
      first_vs <- 1
      last_chapt <- x[1]
      last_vs <- bible_data[book==ref_book & chapter==x[1],total_chapt_verses][1]
    } else if(length(x)==2){
      # can be one vs or a chapter range
      if(grepl('-',y)){
        # if chapter range
        first_chapt <- x[1]
        first_vs <- 1
        last_chapt <- x[2]
        last_vs <- bible_data[book==ref_book & chapter==x[2],total_chapt_verses][1]
      } else {
        # if one vs
        first_chapt <- x[1]
        first_vs <- x[2]
        last_chapt <- x[1]
        last_vs <- x[2]
      }
    } else if(length(x)==3){
      first_chapt <- x[1]
      first_vs <- x[2]
      last_chapt <- x[1]
      last_vs <- x[3]
    } else if(length(x)==4){
      first_chapt <- x[1]
      first_vs <- x[2]
      last_chapt <- x[3]
      last_vs <- x[4]
    } else {
      first_chapt <- NA
      first_vs <- NA
      last_chapt <- NA
      last_vs <- NA  
    }
  }
  data.table(book=ref_book,
             first_chapt=first_chapt,
             first_vs=first_vs,
             end_chapt=last_chapt,
             end_vs=last_vs)
}

DG_refs_dt_w_chap_vs <- cbind(DG_refs_dt,rbindlist(lapply(DG_refs_dt$ref,get_start_and_end_ref_verse_id_v2)))
TGC_refs_dt_w_chap_vs <- cbind(TGC_refs_dt,rbindlist(lapply(TGC_refs_dt$ref,get_start_and_end_ref_verse_id_v2)))



setkey(bible_data,book,chapter,verse)

get_verse_id <- function(dt,type='first'){
  tmp <- dt[,c('book',paste0(type,'_',c('chapt','vs'))),with=FALSE]
  setnames(tmp,colnames(tmp),c('book','chapter','verse'))
  bible_data[tmp,verse_id]
}

DG_refs_dt_w_chap_vs$first_vs_id <- get_verse_id(dt=DG_refs_dt_w_chap_vs,type='first')
DG_refs_dt_w_chap_vs$end_vs_id <- get_verse_id(dt=DG_refs_dt_w_chap_vs,type='end')
DG_refs_dt_w_chap_vs <- DG_refs_dt_w_chap_vs[!is.na(DG_refs_dt_w_chap_vs$book),]
DG_refs_vs_ids <- DG_refs_dt_w_chap_vs[,list(num_ref=.N,vs_ids=list(sort(unlist(lapply(seq(nrow(.SD)),function(y){c(first_vs_id[y]:end_vs_id[y])}))))),by=c('topic','book')]

TGC_refs_dt_w_chap_vs$first_vs_id <- get_verse_id(dt=TGC_refs_dt_w_chap_vs,type='first')
TGC_refs_dt_w_chap_vs$end_vs_id <- get_verse_id(dt=TGC_refs_dt_w_chap_vs,type='end')

TGC_refs_dt_w_chap_vs$topic <- TGC_refs_dt_w_chap_vs$topic %>% 
  gsub("%27",'\'',.) %>% 
  gsub('%2F','/',.) %>% 
  gsub("_"," ",.)

TGC_refs_dt_w_chap_vs$TGC_topic_1 <- sapply(TGC_refs_dt_w_chap_vs$topic,function(y){
  strsplit(y,".",fixed=TRUE)[[1]][1]
})

TGC_refs_dt_w_chap_vs$TGC_topic_2 <- sapply(TGC_refs_dt_w_chap_vs$topic,function(y){
  strsplit(y,".",fixed=TRUE)[[1]][2]
})

TGC_refs_dt_w_chap_vs$TGC_topic_3 <- sapply(TGC_refs_dt_w_chap_vs$topic,function(y){
  strsplit(y,".",fixed=TRUE)[[1]][3]
})

TGC_refs_dt_w_chap_vs <- TGC_refs_dt_w_chap_vs[!is.na(TGC_refs_dt_w_chap_vs$book),]
TGC_refs_dt_w_chap_vs <- TGC_refs_dt_w_chap_vs[!is.na(TGC_refs_dt_w_chap_vs$end_vs_id),]
TGC_refs_dt_w_chap_vs <- TGC_refs_dt_w_chap_vs[!is.na(TGC_refs_dt_w_chap_vs$first_vs_id),]

TGC_refs_vs_ids <- TGC_refs_dt_w_chap_vs[,list(num_ref=.N,vs_ids=list(sort(unlist(lapply(seq(nrow(.SD)),function(y){c(first_vs_id[y]:end_vs_id[y])}))))),by=c('TGC_topic_1','TGC_topic_2','TGC_topic_3','book')]

library(RMySQL)
con <- dbConnect(MySQL(),
                 user = 'root',
                 password = 'Password1',
                 host = 'localhost',
                 dbname='sthelensmediadb')

talk_tbl <- dbReadTable(conn = con, name = 'talk')
product_tbl <- dbReadTable(conn = con, name = 'product')
speaker_tbl <- dbReadTable(conn = con, name = 'speaker')
series_tbl <- dbReadTable(conn = con, name = 'series')
type_tbl <- dbReadTable(conn = con, name = 'type')
book_tbl <- dbReadTable(conn = con, name = 'scr_book')

write.csv(talk_tbl,file='talk_tbl.csv',row.names = FALSE)
write.csv(product_tbl,file='product_tbl.csv',row.names = FALSE)
write.csv(speaker_tbl,file='speaker_tbl.csv',row.names = FALSE)
write.csv(series_tbl,file='series_tbl.csv',row.names = FALSE)
write.csv(type_tbl,file='type_tbl.csv',row.names = FALSE)

get_start_and_end_ref_verse_id_v3 <- function(y){
  print(y)
  if(is.na(y) | y==""){
    ref_book <- NA
    first_chapt <- NA
    first_vs <- NA
    end_chapt <- NA
    end_vs <- NA
  } else {
    ref_book <- last(bible_book_names_v2[sapply(bible_book_names_v2,function(x){grepl(x,y)})])
    if(length(ref_book)!=1){
      # use approximate search for correct book name
      ref_book <- last(bible_book_names_v2[sapply(bible_book_names_v2,function(x){agrepl(x,y)})])
    } else {}
    if(length(ref_book)!=0){
      x <- as.integer(strsplit(gsub(paste0(tolower(ref_book)," "),"",tolower(y)), "[^0-9]+")[[1]])
      if(length(x)==0){
        # Just book given
        first_chapt <- 1
        first_vs <- 1
        last_chapt <- num_chapt_summary[.(ref_book),num_chapt]
        last_vs <- bible_data[book==ref_book & chapter==num_chapt_summary[.(ref_book),num_chapt],total_chapt_verses][1]
      } else if(length(x)==1){
        # just chapter given
        first_chapt <- x[1]
        first_vs <- 1
        last_chapt <- x[1]
        last_vs <- bible_data[book==ref_book & chapter==x[1],total_chapt_verses][1]
      } else if(length(x)==2){
        # can be one vs or a chapter range
        if(grepl('-',y)){
          # if chapter range
          first_chapt <- x[1]
          first_vs <- 1
          last_chapt <- x[2]
          last_vs <- bible_data[book==ref_book & chapter==x[2],total_chapt_verses][1]
        } else {
          # if one vs
          first_chapt <- x[1]
          first_vs <- x[2]
          last_chapt <- x[1]
          last_vs <- x[2]
        }
      } else if(length(x)==3){
        first_chapt <- x[1]
        first_vs <- x[2]
        last_chapt <- x[1]
        last_vs <- x[3]
      } else if(length(x)==4){
        first_chapt <- x[1]
        first_vs <- x[2]
        last_chapt <- x[3]
        last_vs <- x[4]
      } else {
        first_chapt <- NA
        first_vs <- NA
        last_chapt <- NA
        last_vs <- NA  
      }
    } else {
      ref_book <- NA
      first_chapt <- NA
      first_vs <- NA
      last_chapt <- NA
      last_vs <- NA 
    }
  }
    data.table(book=ref_book,
               first_chapt=first_chapt,
               first_vs=first_vs,
               end_chapt=last_chapt,
               end_vs=last_vs)
  
      
}

kk <- rbindlist(lapply(talk_tbl$SCRIPREF,get_start_and_end_ref_verse_id_v3))
kk$first_vs_id <- get_verse_id(dt=kk,type='first')
kk$end_vs_id <- get_verse_id(dt=kk,type='end')
kk_list <- lapply(seq(nrow(kk)),function(y){
  #print(y)
  if(is.na(kk[y,first_vs_id]) | is.na(kk[y,end_vs_id])){
    NA
  }else{
      c(kk[y,first_vs_id]:kk[y,end_vs_id])
  }
})

find_topics <- function(y){
  
}


