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
            /*using (var conn = new SqlConnection(connectionString))
            using (var command = new SqlCommand("CreateTalk", conn)
            {
                CommandType = CommandType.StoredProcedure
            })
            {
                conn.Open();
                command.Parameters.AddWithValue()
                command.ExecuteNonQuery();
                conn.Close();
            }*/
            return CreatedAtRoute("Default", new {id = nextId}, sermon);
        }

        public IHttpActionResult Put(Sermon sermon)
        {
            var sermonToUpdate = sermons.SingleOrDefault(p => p.Talk.id == sermon.Talk.id);
            var index = sermons.IndexOf(sermonToUpdate);
            sermons[index] = sermon;
            return Ok(sermon);
        }

        public IHttpActionResult Delete(Sermon sermon)
        {
            var sermonToDelete = sermons.SingleOrDefault(p => p.Talk.id == sermon.Talk.id);
            var index = sermons.IndexOf(sermonToDelete);
            sermons.RemoveAt(index);
            return Ok();
        }
    }
}