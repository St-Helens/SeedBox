package com.seedbox.config;

import com.jayway.restassured.RestAssured;
import com.seedbox.api.SermonsApi;
import org.junit.Before;
import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.boot.test.IntegrationTest;
import org.springframework.test.context.web.WebAppConfiguration;
import org.springframework.boot.test.SpringApplicationConfiguration;
import org.springframework.test.context.junit4.SpringJUnit4ClassRunner;
import static com.jayway.restassured.RestAssured.*;
import static org.junit.Assert.*;
import static com.jayway.restassured.matcher.RestAssuredMatchers.*;
import static org.hamcrest.Matchers.*;

@RunWith(SpringJUnit4ClassRunner.class)
@SpringApplicationConfiguration(classes = SeedboxRestApplication.class)
@WebAppConfiguration
@IntegrationTest("server.port:0")
public class SeedboxRestApplicationTests {

    @Value("${local.server.port}")   // 6
    int port;

    @Before
    public void setup(){
        RestAssured.port = this.port;
    }



    @Test
    public void pingworks() {
        String response = when().get("v1/sermons").asString();
        assertEquals(SermonsApi.PING, response);
    }

}
