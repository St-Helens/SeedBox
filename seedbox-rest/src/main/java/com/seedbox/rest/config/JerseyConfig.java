package com.seedbox.rest.config;

import com.seedbox.rest.api.SermonsApi;
import org.glassfish.jersey.server.ResourceConfig;

/**
 * Created by Chuckie on 03/10/2015.
 */
public class JerseyConfig extends ResourceConfig {

    public JerseyConfig() {
        packages(SermonsApi.class.getPackage().toString());
    }
}
