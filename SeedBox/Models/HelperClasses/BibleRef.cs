using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace SeedBox.Models.HelperClasses
{
    public class BibleRef
    {
        public String Book { get; set; }
        public int Chapter { get; set; }
        public int Verse { get; set; }
    }
}