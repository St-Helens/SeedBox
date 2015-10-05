using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using SeedBox.Models.HelperClasses;

namespace SeedBox.Models
{
    public class SearchResult
    {
        public string Title { get; set; }
        public string Speaker { get; set; }
        public string VimeoLink { get; set; }
        public string Scripture { get; set; }
        public string Series { get; set; }
        public DateTime DateTime { get; set; }
    }
}