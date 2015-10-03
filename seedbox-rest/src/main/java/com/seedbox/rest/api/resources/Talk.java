package com.seedbox.rest.api.resources;

import javax.xml.bind.annotation.XmlAttribute;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlRootElement;
import java.util.List;

/**
 * Created by Chuckie on 03/10/2015.
 */
@XmlRootElement(name = "talk")
public class Talk {

    private Long id;
    private String code;
    private String title;
    private String bibleReference;
    private String thumbnail;
    private TalkType type;
    private List<TalkDownload> talkDownloads;

    public Long getId() {
        return id;
    }

    @XmlAttribute
    public Talk setId(Long id) {
        this.id = id;
        return this;
    }

    public String getCode() {
        return code;
    }

    @XmlAttribute
    public Talk setCode(String code) {
        this.code = code;
        return this;
    }

    public String getTitle() {
        return title;
    }

    @XmlElement
    public Talk setTitle(String title) {
        this.title = title;
        return this;
    }

    public String getBibleReference() {
        return bibleReference;
    }

    @XmlElement
    public Talk setBibleReference(String bibleReference) {
        this.bibleReference = bibleReference;
        return this;
    }

    public String getThumbnail() {
        return thumbnail;
    }

    @XmlElement
    public Talk setThumbnail(String thumbnail) {
        this.thumbnail = thumbnail;
        return this;
    }

    public TalkType getType() {
        return type;
    }

    @XmlElement
    public Talk setType(TalkType type) {
        this.type = type;
        return this;
    }

    public List<TalkDownload> getTalkDownloads() {
        return talkDownloads;
    }

    @XmlElement
    public Talk setTalkDownloads(List<TalkDownload> talkDownloads) {
        this.talkDownloads = talkDownloads;
        return this;
    }
}
