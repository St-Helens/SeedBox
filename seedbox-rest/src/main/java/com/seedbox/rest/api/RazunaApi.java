package com.seedbox.rest.api;

import com.seedbox.rest.modals.Razuna;
import com.seedbox.rest.modals.RazunaCustomFields;
import org.springframework.http.ResponseEntity;
import org.springframework.web.client.RestTemplate;

import javax.annotation.Generated;
import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.core.HttpHeaders;

/**
 * Created by Nim on 03/10/2015.
 */
@Path("/v1/razuna/assetLookup")
public class RazunaApi {

    public static final String PING = "Please specify and asset to search";

    @GET

    public String ping() {
        return PING;
    }

    @GET
    @Path("/{id}")
    public String asset(@PathParam("id") String id) {
        RestTemplate restTemplate = new RestTemplate();
        //Razuna razuna = restTemplate.getForObject("http://razuna.nimothy.com/razuna/global/api2/search.cfc?method=searchassets&api_key=50B3E4C9A6D54C47B045D0714183F8AF&searchfor=*", Razuna.class);
        //restTemplate
        return null;
    }

    @GET
    @Path("/customFields")
    public String customFields(){
        RestTemplate restTemplate = new RestTemplate();
        //ResponseEntity<String> razunaCustomFields = restTemplate.getForEntity("http://razuna.nimothy.com/razuna/global/api2/customfield.cfc?method=getall&api_key=50B3E4C9A6D54C47B045D0714183F8AF&_BDRETURNFORMAT=column", String.class);
        RazunaCustomFields razunaCustomFields = restTemplate.getForObject("http://razuna.nimothy.com/razuna/global/api2/customfield.cfc?method=getall&api_key=50B3E4C9A6D54C47B045D0714183F8AF", RazunaCustomFields.class);
        System.out.println("HERE");
        /*System.out.println(razunaCustomFields.getBody());
        System.out.println(razunaCustomFields.getHeaders().getContentType());*/
        return razunaCustomFields.toString();
    }

}

