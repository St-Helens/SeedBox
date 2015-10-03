package com.seedbox.rest.api;

import com.fasterxml.jackson.core.JsonParseException;
import com.fasterxml.jackson.databind.JsonMappingException;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.google.gson.Gson;
import com.seedbox.rest.modals.RazunaQuery;
import org.apache.commons.lang3.StringEscapeUtils;
import org.slf4j.ext.XLogger;
import org.slf4j.ext.XLoggerFactory;
import org.springframework.web.client.RestTemplate;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

/**
 * Created by Nim on 03/10/2015.
 */
@Path("/v1/razuna/assetLookup")
public class RazunaApi {

    private static final XLogger logger = XLoggerFactory.getXLogger(RazunaApi.class);

    public static final String PING = "Please specify and asset to search";
    public static final String APIKEY = "50B3E4C9A6D54C47B045D0714183F8AF";

    @GET
    public String ping() {
        return PING;
    }

    @GET
    @Path("/test")
    public String asset() {
        RestTemplate restTemplate = new RestTemplate();
        String razunaQueryJson = restTemplate.getForObject("http://razuna.nimothy.com/razuna/global/api2/search.cfc?method=searchassets&api_key=" + APIKEY + "&searchfor=*", String.class);
        Gson gson = new Gson();
        RazunaQuery razunaQuery = gson.fromJson(razunaQueryJson, RazunaQuery.class);
        //RazunaQuery razunaQuery[] = restTemplate.getForObject("http://razuna.nimothy.com/razuna/global/api2/search.cfc?method=searchassets&api_key=" + APIKEY + "&searchfor=*", RazunaQuery[].class);
        List<String> listOfIds = new ArrayList<String>();

//        for (RazunaQuery response : razunaQuery) {
        popluateIdList(listOfIds, razunaQuery);
//        }

        StringBuilder sb = new StringBuilder();
        for (String s : listOfIds)
        {
            sb.append(s);
            sb.append(",");
        }

        return sb.toString(); //razunaQuery.toStrings();
    }

    private void popluateIdList(List<String> listOfIds, RazunaQuery response) {
        int indexOfId = getIdIndex(response.getCOLUMNS());
        for (List<String> data : response.getDATA()) {
            listOfIds.add(data.get(indexOfId));
        }
    }


    private int getIdIndex(List<String> columns) {
        int i = 0;
        for (String value : columns) {
            if (value.equalsIgnoreCase("id")) {
                return i;
            }
            ++i;
        }
        throw new IllegalStateException("No id field!");
    }

    public RazunaQuery fromJson(String json) throws JsonParseException
            , JsonMappingException, IOException {
        RazunaQuery razunaResponse = new ObjectMapper().readValue(json, RazunaQuery.class);

        return razunaResponse;
    }

}

