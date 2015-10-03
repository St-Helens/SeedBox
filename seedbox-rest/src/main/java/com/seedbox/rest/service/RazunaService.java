package com.seedbox.rest.service;

import com.fasterxml.jackson.core.JsonParseException;
import com.fasterxml.jackson.databind.JsonMappingException;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.google.gson.Gson;
import com.seedbox.rest.modals.RazunaQuery;
import org.springframework.stereotype.Component;
import org.springframework.web.client.RestTemplate;

import javax.inject.Named;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

/**
 * Created by Chuckie on 03/10/2015.
 */
@Component
@Named
public class RazunaService {

    public static final String APIKEY = "50B3E4C9A6D54C47B045D0714183F8AF";

    public List<String> getRazunaQueryIds(String query){

        RestTemplate restTemplate = new RestTemplate();
        String razunaQueryJson = restTemplate.getForObject("http://razuna.nimothy.com/razuna/global/api2/search.cfc?method=searchassets&api_key=" + APIKEY + "&searchfor=" + query, String.class);
        Gson gson = new Gson();
        RazunaQuery razunaQuery = gson.fromJson(razunaQueryJson, RazunaQuery.class);
        List<String> listOfIds = new ArrayList<String>();

        popluateIdList(listOfIds, razunaQuery);

        return listOfIds;

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


}
