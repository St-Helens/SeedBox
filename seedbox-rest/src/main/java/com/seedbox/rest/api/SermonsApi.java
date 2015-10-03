package com.seedbox.rest.api;

import com.fasterxml.jackson.databind.ObjectMapper;
import com.seedbox.rest.api.resources.*;
import org.apache.commons.lang3.exception.ExceptionUtils;
import org.slf4j.ext.XLogger;
import org.slf4j.ext.XLoggerFactory;
import org.springframework.core.NestedExceptionUtils;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;
import javax.xml.bind.JAXBContext;
import javax.xml.bind.JAXBException;
import javax.xml.bind.Marshaller;
import java.util.ArrayList;
import java.util.List;

/**
 * Created by Chuckie on 03/10/2015.
 */
@Path("/v1/sermons")
public class SermonsApi {

    public static final String PING = "ping";
    private XLogger logger = XLoggerFactory.getXLogger(SermonsApi.class);

    @GET
    public String ping() {
        return PING;
    }

    @GET
    @Path("/recent")
    @Produces(MediaType.APPLICATION_XML)
    public TalkList getRecentTalksList(){
        logger.info("ENTERING METHOD");
        TalkList talkList = new TalkList();
        try{
        JAXBContext context = JAXBContext.newInstance(TalkList.class);


        Marshaller m = context.createMarshaller();
        m.setProperty(Marshaller.JAXB_FORMATTED_OUTPUT, true);

            List<Talk> talks = new ArrayList<Talk>();
            List<TalkDownload> talkDownloads = new ArrayList<TalkDownload>();
            talkDownloads.add(new TalkDownload().setId(45L).setLocation("somewhereoutthere.mp3").setSize(100000).setTalkDownloadType(new TalkDownloadType().setValue("mp3")));
            talks.add(new Talk().setCode("123").setId(1L).setBibleReference("gen").setThumbnail("some.jpg").setTitle("hello").setType(new TalkType().setId(123L).setValue("SM")).setTalkDownloads(talkDownloads));
            talks.add(new Talk().setCode("abc").setId(2L).setBibleReference("gen").setThumbnail("some.jpg").setTitle("hello").setType(new TalkType().setId(123L).setValue("SM")).setTalkDownloads(talkDownloads));
            talks.add(new Talk().setCode("def").setId(3L).setBibleReference("gen").setThumbnail("some.jpg").setTitle("hello").setType(new TalkType().setId(123L).setValue("SM")).setTalkDownloads(talkDownloads));

            talkList.setTotal(100000).setTalks(talks);

            m.marshal(talkList, System.out);
        } catch (JAXBException e) {
            logger.error(ExceptionUtils.getStackTrace(e));
        }
        logger.info("LEAVING METHOD");
        return talkList;
    }

    @GET
    @Path("/id/{id}")
    public String something(@PathParam("id") String id){
        return id;
    }


}