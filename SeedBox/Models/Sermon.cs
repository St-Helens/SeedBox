using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using SeedBox.Models.HelperClasses;

namespace SeedBox.Models
{
    public class Sermon
    {
        public int id { get; set; }
        public Talk Talk { get; set; }
        public String Title { get; set; }
        public int Talktype { get; set; }
        public BibleRef refStart { get; set; }
        public BibleRef refEnd { get; set; }
        public DateTime DateTime { get; set; }
        public Series Series { get; set; }
        public Downloads mp3 { get; set; }
        public Downloads Video { get; set; }
        public String Speaker { get; set; }
        public string Thumbnail { get; set; }
    }
}