package com.seedbox.rest.modals;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;

import javax.ws.rs.GET;
import javax.ws.rs.Path;

/*
 * Created by Nim on 03/10/2015.
 */
@JsonIgnoreProperties(ignoreUnknown = true)
public class Razuna {
    private int ID;

    public Razuna(){

    }

    public int getId(){
        return this.ID;
    }

    public void setId(int id){
        this.ID = id;
    }

    @Override
    public String toString() {
        return "format of the stuff";
    }
}