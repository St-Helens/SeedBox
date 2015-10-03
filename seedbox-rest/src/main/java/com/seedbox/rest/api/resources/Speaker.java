package com.seedbox.rest.api.resources;

import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlRootElement;

/**
 * Created by Chuckie on 03/10/2015.
 */
@XmlRootElement(name = "speaker")
public class Speaker {

    private String name;

    public String getName() {
        return name;
    }

    @XmlElement
    public Speaker setName(String name) {
        this.name = name;
        return this;
    }
}
