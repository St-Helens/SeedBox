package com.seedbox.config;

import com.seedbox.api.SermonsApi;
import org.glassfish.jersey.server.ResourceConfig;
import org.springframework.stereotype.Component;

/**
 * Created by Chuckie on 03/10/2015.
 */
@Component
public class JerseyConfig extends ResourceConfig {

    public JerseyConfig() {
        packages(SermonsApi.class.getPackage().toString());
    }
}
