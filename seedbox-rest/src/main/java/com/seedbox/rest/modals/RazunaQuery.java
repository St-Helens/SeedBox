package com.seedbox.rest.modals;

import com.fasterxml.jackson.annotation.JsonCreator;
import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import java.util.List;

/*
 * Created by Nim on 03/10/2015.
 */
@JsonIgnoreProperties(ignoreUnknown = true)
public class RazunaQuery {
    private List<String> COLUMNS;
    private List<List<String>> DATA;

    public RazunaQuery(){

    }

    @JsonCreator
    public RazunaQuery(@JsonProperty("COLUMNS") List<String> COLUMNS,
                       @JsonProperty("DATA") List<List<String>> DATA){
        this.DATA = DATA;
        this.COLUMNS = COLUMNS;

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