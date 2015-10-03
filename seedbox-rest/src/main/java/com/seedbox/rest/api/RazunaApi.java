package com.seedbox.rest.api;

import com.seedbox.rest.modals.RazunaQuery;
import org.springframework.web.client.RestTemplate;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import java.util.ArrayList;
import java.util.List;

/**
 * Created by Nim on 03/10/2015.
 */
@Path("/v1/razuna/assetLookup")
public class RazunaApi {

    public static final String PING = "Please specify and asset to search";
    public static final String APIKEY = "50B3E4C9A6D54C47B045D0714183F8AF";

    @GET

    public String ping() {
        return PING;
    }

    @GET
    @Path("/{query}")
    public List<Long> asset(@PathParam("query") String query) {
        RestTemplate restTemplate = new RestTemplate();
        RazunaQuery razunaQuery[] = restTemplate.getForObject("http://razuna.nimothy.com/razuna/global/api2/search.cfc?method=searchassets&api_key=" + APIKEY + "&searchfor=" + query, RazunaQuery[].class);
        //RazunaQuery razunaQuery[] = restTemplate.getForObject("http://razuna.nimothy.com/razuna/global/api2/search.cfc?method=searchassets&api_key=" + APIKEY + "&searchfor=*", RazunaQuery[].class);
        List<Long> listOfIds = new ArrayList<Long>();

        for (RazunaQuery response : razunaQuery) {
            popluateIdList(listOfIds, response);
        }

        return listOfIds; //razunaQuery.toStrings();
    }

    private void popluateIdList(List<Long> listOfIds, RazunaQuery response) {
        int indexOfId = getIdIndex(response.getCOLUMNS());
        for(String[] data : response.getDATA()){
            listOfIds.add(Long.parseLong(data[indexOfId]));
        }
    }


    private int getIdIndex(String[] columns) {
        int i = 0;
        for (String value : columns) {
            if (value.equalsIgnoreCase("id")) {
                return i;
            }
            ++i;
        }
        throw new IllegalStateException("No id field!");
    }
}

