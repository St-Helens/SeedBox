using System.Collections.Generic;
using System.Configuration;
using System.Data.SqlClient;
using System.Web.Http;
using SeedBox.Models;

namespace SeedBox.Controllers
{
    public class SearchController : ApiController
    {
        private readonly string connectionString = ConfigurationManager.ConnectionStrings["SeedBox"].ConnectionString;
        //private static List<Sermon> sermons = new List<Sermon>();
        private static List<SearchResult> results = new List<SearchResult>(); 
        public IHttpActionResult Get()
        {
            results.Clear();
            string sql = "SELECT * FROM searchTalks$ WHERE external_url is not null and Series is not null and name is not null and scripref is not null";
            using (var cnn = new SqlConnection(connectionString))
            {
                cnn.Open();
                using (var cmd = new SqlCommand(sql, cnn))
                {
                    using (SqlDataReader reader = cmd.ExecuteReader())
                    {

                        if (reader.HasRows)
                        {
                            // Get ordinals from the customers table
                            int titleOrdinal = reader.GetOrdinal("talk");
                            int scriptureOrdinal = reader.GetOrdinal("scripref");
                            int seriesOrdinal = reader.GetOrdinal("Series");
                            int speakerOrdinal = reader.GetOrdinal("name");
                            int vimeoOrdinal = reader.GetOrdinal("external_url");
                            int dateOrdinal = reader.GetOrdinal("date");

                            while (reader.Read())
                            {
                                SearchResult result = new SearchResult();
                                result.Title = reader.GetString(titleOrdinal);
                                result.Speaker = reader.GetString(speakerOrdinal);
                                var tempVimeo = reader.GetString(vimeoOrdinal);
                                result.VimeoLink = tempVimeo.Substring(tempVimeo.LastIndexOf(@"/") + 1,
                                    tempVimeo.Length - tempVimeo.LastIndexOf(@"/") - 1);
                                result.Scripture = reader.GetString(scriptureOrdinal);
                                result.Series = reader.GetString(seriesOrdinal);
                                result.DateTime = reader.GetDateTime(dateOrdinal);

                                results.Add(result);
                            } 
                            reader.Close();
                        }
                    }
                }
            }
            return Ok(results);
        }
    }
}
