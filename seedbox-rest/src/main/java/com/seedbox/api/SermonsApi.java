package com.seedbox.api;

import javax.ws.rs.GET;
import javax.ws.rs.Path;

/**
 * Created by Chuckie on 03/10/2015.
 */
@Path("/v1/sermons")
public class SermonsApi {

    public static final String PING = "ping";

    @GET
    public String ping(){
        return PING;
    }
//
//    @Path("/recent")
//    public



}
