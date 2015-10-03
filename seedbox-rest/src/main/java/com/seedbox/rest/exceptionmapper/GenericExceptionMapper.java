package com.seedbox.rest.exceptionmapper;

import org.slf4j.ext.XLogger;
import org.slf4j.ext.XLoggerFactory;
import org.springframework.stereotype.Component;

import javax.ws.rs.core.Response;
import javax.ws.rs.ext.ExceptionMapper;
import javax.ws.rs.ext.Provider;

/**
 * Created by Chuckie on 03/10/2015.
 */
@Provider
@Component
public class GenericExceptionMapper implements ExceptionMapper<Throwable> {

    private XLogger logger = XLoggerFactory.getXLogger(GenericExceptionMapper.class);

    public Response toResponse(Throwable throwable) {
        logger.info("ELLO");
        logger.error("Uncaught Exception!");
        logger.catching(XLogger.Level.ERROR, throwable);
        return Response.serverError().entity("Internal Server Error. Oops").build();
    }
}
