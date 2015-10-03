package com.seedbox.rest.modals;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;

import javax.ws.rs.GET;
import javax.ws.rs.Path;

/*
 * Created by Nim on 03/10/2015.
 */
@JsonIgnoreProperties(ignoreUnknown = true)
public class RazunaQuery {
    private String[] COLUMNS;
    private String[][] DATA;

    public RazunaQuery(){

    }

    public String[] getCOLUMNS() {
        return COLUMNS;
    }

    public void setCOLUMNS(String[] COLUMNS) {
        this.COLUMNS = COLUMNS;
    }

    public String[][] getDATA() {
        return DATA;
    }

    public void setDATA(String[][] DATA) {
        this.DATA = DATA;
    }

    @Override
    public String toString() {
        return "format of the stuff";
    }
}