package com.seedbox.rest.config;

import com.fasterxml.jackson.databind.ObjectMapper;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.ComponentScan;
import org.springframework.context.annotation.Configuration;

/**
 * Created by Chuckie on 03/10/2015.
 */
@Configuration
@ComponentScan("com.seedbox")
public class SpringConfig {

    @Bean
    public ObjectMapper getObjectMapper(){
        return new ObjectMapper();
    }


}
