package com.seedbox.rest.api.resources;

import javax.xml.bind.annotation.XmlRootElement;
import javax.xml.bind.annotation.XmlValue;

/**
 * Created by Chuckie on 03/10/2015.
 */
@XmlRootElement(name = "type")
public class TalkDownloadType {

    private String value;

    public String getValue() {
        return value;
    }

    @XmlValue
    public TalkDownloadType setValue(String value) {
        this.value = value;
        return this;
    }
}
