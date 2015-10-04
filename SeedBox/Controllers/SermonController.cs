using System;
using System.Collections.Generic;
using System.Configuration;
using System.Data;
using System.Linq;
using System.Web;
using System.Web.Http;
using SeedBox.Models;
using SeedBox.Models.HelperClasses;
using System.Data.SqlClient;

namespace SeedBox.Controllers
{
    public class SermonController : ApiController
    {
        private readonly string connectionString = ConfigurationManager.ConnectionStrings["SeedBox"].ConnectionString;
        private static List<Sermon> sermons = new List<Sermon>();
        public IHttpActionResult Get()
        {
            return Ok(sermons);
        }

        public IHttpActionResult Post(Sermon sermon)
        {
            var nextId = sermons.Count + 1;
            sermon.Talk.id = nextId;
            sermons.Add(sermon);
            try
            {
                using (var conn = new SqlConnection(connectionString))
                using (var command = new SqlCommand("CreateTalk", conn)
                {
                    CommandType = CommandType.StoredProcedure
                })
                {
                    conn.Open();
                    command.Parameters.AddWithValue("@id", sermon.id);
                    command.Parameters.AddWithValue("@talk_id", sermon.Talk.id);
                    command.Parameters.AddWithValue("@talk_code", sermon.Talk.code);
                    command.Parameters.AddWithValue("@Talktype", sermon.Talktype);
                    command.Parameters.AddWithValue("@Title", sermon.Title);
                    command.Parameters.AddWithValue("@refStart_book", sermon.refStart.Book);
                    command.Parameters.AddWithValue("@refStart_chapter", sermon.refStart.Chapter);
                    command.Parameters.AddWithValue("@refStart_verse", sermon.refStart.Verse);
                    command.Parameters.AddWithValue("@refEnd_book", sermon.refEnd.Book);
                    command.Parameters.AddWithValue("@refEnd_chapter", sermon.refEnd.Chapter);
                    command.Parameters.AddWithValue("@refEnd_verse", sermon.refEnd.Verse);
                    //command.Parameters.AddWithValue("@Date", sermon.DateTime.Date);
                    command.Parameters.AddWithValue("@series_id", sermon.Series.id);
                    command.Parameters.AddWithValue("@Series_title", sermon.Series.Title);
                    command.Parameters.AddWithValue("@mp3_location", sermon.mp3.location);
                    command.Parameters.AddWithValue("@video_location", sermon.Video.location);
                    command.Parameters.AddWithValue("@Speaker", sermon.Speaker);
                    command.Parameters.AddWithValue("@Thumbnail", sermon.Thumbnail);
                    command.ExecuteNonQuery();
                    conn.Close();
                }
            }
            catch (Exception ex)
            {
                Console.WriteLine(ex.Message);
            }
            return CreatedAtRoute("Default", new {id = nextId}, sermon);
        }

        public IHttpActionResult Put(Sermon sermon)
        {
            var sermonToUpdate = sermons.FirstOrDefault(p => p.Talk.id == sermon.Talk.id);
            var index = sermons.IndexOf(sermonToUpdate);
            sermons[index] = sermon;
            return Ok(sermon);
        }

        public IHttpActionResult Delete(Sermon sermon)
        {
            var sermonToDelete = sermons.FirstOrDefault(p => p.Talk.id == sermon.Talk.id);
            var index = sermons.IndexOf(sermonToDelete);
            sermons.RemoveAt(index);
            return Ok();
        }
    }
}