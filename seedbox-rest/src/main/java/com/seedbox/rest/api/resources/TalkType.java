package com.seedbox.rest.api.resources;

import javax.xml.bind.annotation.XmlAttribute;
import javax.xml.bind.annotation.XmlRootElement;
import javax.xml.bind.annotation.XmlValue;

/**
 * Created by Chuckie on 03/10/2015.
 */
@XmlRootElement(name = "type")
public class TalkType {

    private Long id;
    private String value;

    public Long getId() {
        return id;
    }

    @XmlAttribute
    public TalkType setId(Long id) {
        this.id = id;
        return this;
    }


    public String getValue() {
        return value;
    }

    @XmlValue
    public TalkType setValue(String value) {
        this.value = value;
        return this;
    }
}
