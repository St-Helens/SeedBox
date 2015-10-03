package com.seedbox.rest.api.resources;

import javax.xml.bind.annotation.XmlAttribute;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlRootElement;

/**
 * Created by Chuckie on 03/10/2015.
 */
@XmlRootElement(name = "downloads")
public class TalkDownload {

    private Long id;
    private TalkDownloadType talkDownloadType;
    private Integer size;
    private String location;

    public Long getId() {
        return id;
    }

    @XmlAttribute
    public TalkDownload setId(Long id) {
        this.id = id;
        return this;
    }

    public TalkDownloadType getTalkDownloadType() {
        return talkDownloadType;
    }

    @XmlElement(name = "type")
    public TalkDownload setTalkDownloadType(TalkDownloadType talkDownloadType) {
        this.talkDownloadType = talkDownloadType;
        return this;
    }

    public Integer getSize() {
        return size;
    }

    @XmlElement
    public TalkDownload setSize(Integer size) {
        this.size = size;
        return this;
    }

    public String getLocation() {
        return location;
    }

    @XmlElement
    public TalkDownload setLocation(String location) {
        this.location = location;
        return this;
    }
}
