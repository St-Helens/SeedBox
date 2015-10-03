package com.seedbox.rest.api.resources;

import javax.xml.bind.annotation.XmlAttribute;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlRootElement;
import java.util.List;

/**
 * Created by Chuckie on 03/10/2015.
 */

@XmlRootElement(name = "talklist")
public class TalkList {


    private Integer total;
    private List<Talk> talks;


    public Integer getTotal() {
        return total;
    }

    @XmlAttribute
    public TalkList setTotal(Integer total) {
        this.total = total;
        return this;
    }


    public List<Talk> getTalks() {
        return talks;
    }

    @XmlElement(name = "talk")
    public TalkList setTalks(List<Talk> talks) {
        this.talks = talks;
        return this;
    }
}
