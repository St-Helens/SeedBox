package com.seedbox.rest.modals;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import javax.ws.rs.GET;
import javax.ws.rs.Path;
import java.util.List;

/**
 * Created by Nim on 03/10/2015.
 */
@JsonIgnoreProperties(ignoreUnknown = true)
public class RazunaCustomFields {
    private List<String> COLUMNS;
    private List<List<String>> DATA;

    public  RazunaCustomFields(){

    }

    public List<String> getCOLUMNS() {
        return COLUMNS;
    }

    public void setCOLUMNS(List<String> COLUMNS) {
        this.COLUMNS = COLUMNS;
    }

    public List<List<String>> getDATA() {
        return DATA;
    }

    public void setDATA(List<List<String>> DATA) {
        this.DATA = DATA;
    }

    @Override
    public String toString() {
        return "format of the stuff";
    }
}