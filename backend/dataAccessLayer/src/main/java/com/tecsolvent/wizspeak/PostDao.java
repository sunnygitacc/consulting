package com.tecsolvent.wizspeak;

import com.google.common.collect.Maps;
import com.tecsolvent.wizspeak.model.Post;
import org.apache.log4j.Logger;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.jdbc.core.ResultSetExtractor;
import org.springframework.jdbc.core.simple.SimpleJdbcInsert;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Iterator;
import java.util.Map;

/**
 *
 *
 * Created by jaison on 16/3/16.
 */
public class PostDao {

	public static Logger logger = Logger.getLogger(PostDao.class);

	private JdbcTemplate masterJdbcTemplate;
	private JdbcTemplate slaveJdbcTemplate;


	public void setMasterJdbcTemplate(JdbcTemplate masterJdbcTemplate) {
		this.masterJdbcTemplate = masterJdbcTemplate;
	}

	public void setSlaveJdbcTemplate(JdbcTemplate slaveJdbcTemplate) {
		this.slaveJdbcTemplate = slaveJdbcTemplate;
	}




	public ArrayList<Post> getAmbitionPosts(long user_id,int verticalId) throws Exception{

		ArrayList<Post> posts = new ArrayList<Post>();
		try{
			logger.error(" no errots  ");
			posts = slaveJdbcTemplate.query("SELECT id,postby_id, postto_id, title, description, link, post_type_id FROM posts WHERE postto_id = "+user_id+" AND wall_type = "+verticalId+" AND vertical_id = 1 AND status = 1 ORDER BY id DESC limit 10 ", new PostMapper());
		}catch (Exception e){

			logger.error(" error getting ambition posts  "+e);

		}
		return posts;

	}

	public ArrayList<Post> getProfileMedia(long user_id,int verticalId) throws Exception{

		ArrayList<Post> posts = new ArrayList<Post>();
		try{
			logger.error(" no errots  ");
			posts = slaveJdbcTemplate.query("SELECT id,postby_id, postto_id, title, description, link, post_type_id FROM posts WHERE postto_id = "+user_id+" AND post_type_id = "+verticalId+" AND vertical_id = 1 AND status = 1 ORDER BY id DESC limit 20 ", new PostMapper());
		}catch (Exception e){

			logger.error(" error getting ambition media  "+e);

		}
		return posts;

	}



	public ArrayList<Post> getCreativityPosts(long user_id,int verticalId) throws Exception{

		ArrayList<Post> posts = new ArrayList<Post>();
		try{
			logger.error(" no error  ");
			posts = slaveJdbcTemplate.query("SELECT id,postby_id, postto_id, title, description, link, post_type_id FROM posts WHERE post_type_id = "+verticalId+" AND vertical_id = 3 AND status = 1 ORDER BY id DESC limit 10 ", new CrePostMapper());
		}catch (Exception e){

			logger.error(" error getting cre posts  "+e);

		}
		return posts;

	}

	public ArrayList<Post> creativityPlayer(long user_id,int verticalId) throws Exception{

		ArrayList<Post> posts = new ArrayList<Post>();
		try{
			logger.error(" no error  ");
			posts = slaveJdbcTemplate.query("SELECT id,postby_id, postto_id, title, description, link, post_type_id FROM posts WHERE id = "+user_id+" AND post_type_id = "+verticalId+" AND vertical_id = 3 AND status = 1 ORDER BY id DESC limit 10 ", new CrePlayerMapper());
		}catch (Exception e){

			logger.error(" error getting cre posts  "+e);

		}
		return posts;

	}






	public ArrayList<Post> getPosts(ArrayList<Long> userIds,ArrayList<Long> groupIds,int isPrivate,int postType) throws Exception{

		ArrayList<Post> posts = new ArrayList<Post>();

		String condition = "";


		String userStr ="";
		String groupStr = "";

		if(!userIds.isEmpty()){

			Iterator userItr = userIds.iterator();
			String init = "(";
			while(userItr.hasNext()){
				init += userItr.next()+",";

			}
			int size = init.length();
			userStr = init.substring(0, size-1);
			userStr +=")";

			//condition for user
			condition = condition+" (postto_id IN "+userStr+" AND wall_type = 1) OR ";
		}else{
			userStr = "()";
		}

		if(!groupIds.isEmpty()){

			Iterator groupItr = groupIds.iterator();
			String gIds = "(";
			while(groupItr.hasNext()){
				gIds += groupItr.next()+",";

			}
			int size = gIds.length();
			groupStr = gIds.substring(0, size-1);
			groupStr +=")";

		}else {

			groupStr= "()";
		}


		//condition for user
		condition = condition+" (postto_id IN "+groupStr+" AND wall_type = 2 AND is_private = "+isPrivate+") ";

		if(postType>0){

			condition = condition+" AND post_type_id = "+postType;
		}




		try{
			logger.error("SELECT id,postby_id, postto_id, title, description, link, post_type_id FROM posts WHERE "+condition+" AND status = 1 ORDER BY id DESC limit 10 ");
			posts = slaveJdbcTemplate.query("SELECT id,postby_id, postto_id, title, description, link, post_type_id FROM posts WHERE "+condition+" AND status = 1 ORDER BY id DESC limit 10 ", new PostMapper());
		}catch (Exception e){

			logger.error(" error getting ambition posts  "+e);

		}
		return posts;

	}




	private class PostMapper implements ResultSetExtractor<ArrayList<Post>>{

		public ArrayList<Post> extractData(ResultSet resultSet) throws SQLException{

			ArrayList<Post> posts = new ArrayList<Post>();

			while (resultSet.next()){


				Post p =new Post(
						resultSet.getLong("id"),
						resultSet.getLong("postby_id"),
						resultSet.getLong("postto_id"),
						resultSet.getString("title"),
						resultSet.getString("link"),
						resultSet.getInt("post_type_id")

				);

				posts.add(p);
			}

			return posts;
		}


	}


	private class CrePostMapper implements ResultSetExtractor<ArrayList<Post>>{

		public ArrayList<Post> extractData(ResultSet resultSet) throws SQLException{

			ArrayList<Post> posts = new ArrayList<Post>();

			while (resultSet.next()){


				Post p =new Post(
						resultSet.getLong("id"),
						resultSet.getLong("postby_id"),
						resultSet.getLong("postto_id"),
						resultSet.getString("title"),
						resultSet.getString("link"),
						resultSet.getInt("post_type_id")

				);

				posts.add(p);
			}

			return posts;
		}


	}

	private class CrePlayerMapper implements ResultSetExtractor<ArrayList<Post>>{

		public ArrayList<Post> extractData(ResultSet resultSet) throws SQLException{

			ArrayList<Post> posts = new ArrayList<Post>();

			while (resultSet.next()){


				Post p =new Post(
						resultSet.getLong("id"),
						resultSet.getLong("postby_id"),
						resultSet.getLong("postto_id"),
						resultSet.getString("title"),
						resultSet.getString("link"),
						resultSet.getInt("post_type_id")

				);

				posts.add(p);
			}

			return posts;
		}


	}




	public HashMap<String, String> addPost(Post post)
			throws Exception
	{

		SimpleJdbcInsert simpleJdbcInsert = new SimpleJdbcInsert(this.masterJdbcTemplate).withTableName("posts").usingGeneratedKeyColumns(new String[] { "id" }).usingColumns(new String[] { "postby_id", "postto_id", "wall_type", "is_private", "post_type_id", "vertical_id", "title", "status", "link" });

		Map<String, Object> testInsertMap = Maps.newHashMap();
		testInsertMap.put("postby_id", "" + post.getPostby_id() + "");
		testInsertMap.put("postto_id", "" + post.getPostto_id() + "");
		testInsertMap.put("wall_type", "" + post.getWall_type() + "");
		testInsertMap.put("is_private", "" + post.isPrivate() + "");
		testInsertMap.put("post_type_id", "" + post.getPost_type_id() + "");
		testInsertMap.put("vertical_id", "" + post.getVertical_id() + "");
		testInsertMap.put("title", "" + post.getTitle() + "");
		testInsertMap.put("status", "" + post.getStatus() + "");
		testInsertMap.put("link", "" + post.getLink() + "");

		HashMap<String, String> status = new HashMap();
		status.put("success", "0");
		try
		{
			Number newId = simpleJdbcInsert.executeAndReturnKey(testInsertMap);
			logger.info("success = " + newId.longValue());

			status.put("success", "1");
			status.put("post_id", "" + newId.longValue());
			HashMap<String, String> localHashMap1 = status;

		}
		catch (Exception e)
		{
			logger.error("error in posting "+e);


		}

		return status;
	}




	public ArrayList<Post> getPost(ArrayList<Long> id)throws Exception{

		Iterator itr = id.iterator();
		String init = "(";
		while(itr.hasNext()){
			init += itr.next()+",";

		}
		int size = init.length();
		String str = init.substring(0, size-1);
		str +=")";
		ArrayList<Post> posts = new ArrayList<>();
		try{
			posts = slaveJdbcTemplate.query("SELECT id,postby_id, postto_id, title, description, link, post_type_id FROM posts WHERE id IN  "+str, new PostMapper());

		}catch (Exception e){

			logger.error("error selecting single posts "+e);


		}
		return posts;

	}




	public Map<String,Object> updatePostText(Post post) throws SQLException {

		java.util.Date dt = new java.util.Date();
		java.text.SimpleDateFormat sdf = new java.text.SimpleDateFormat("yyyy-MM-dd HH:mm:ss");

		String currentTime = sdf.format(dt);

		Map<String,Object> p = new HashMap<>();
		String SQL = "UPDATE posts SET title = ? , date_updated =? WHERE id = ?";

		slaveJdbcTemplate.update(SQL, post.getTitle(),currentTime ,post.getId());
		p.put("success","1");
		logger.error("updated  post text");



		return p;
	}

	public Map<String,Object> deletePost(Map<String,Object> del) throws SQLException {

		java.util.Date dt = new java.util.Date();
		java.text.SimpleDateFormat sdf = new java.text.SimpleDateFormat("yyyy-MM-dd HH:mm:ss");

		String currentTime = sdf.format(dt);
		logger.info("delete post data layer");
		Map<String,Object> p = new HashMap<>();
		String SQL = "UPDATE posts SET deletedby_id = ? ,date_deleted = ? ,status = ? WHERE id = ? ";

		slaveJdbcTemplate.update(SQL, del.get("user_id"),currentTime ,del.get("status"),del.get("post_id"));
		p.put("success","1");


		return p;
	}


	public ArrayList<Post> getMentorPosts(long user_id,int verticalId) throws Exception{

		ArrayList<Post> mposts = new ArrayList<Post>();
		try{
			logger.error(" no errots  ");
			mposts = slaveJdbcTemplate.query("SELECT id,postby_id, postto_id, title, description, link, post_type_id FROM posts WHERE postto_id = "+user_id+" AND wall_type = "+verticalId+" AND vertical_id = 5 AND status = 1 ORDER BY id DESC limit 10 ", new MPostMapper());
		}catch (Exception e){

			logger.error(" error getting ambitionz posts  "+e);

		}
		return mposts;

	}

	private class MPostMapper implements ResultSetExtractor<ArrayList<Post>>{

		public ArrayList<Post> extractData(ResultSet resultSet) throws SQLException{

			ArrayList<Post> mposts = new ArrayList<Post>();

			while (resultSet.next()){


				Post mp =new Post(
						resultSet.getLong("id"),
						resultSet.getLong("postby_id"),
						resultSet.getLong("postto_id"),
						resultSet.getString("title"),
						resultSet.getString("link"),
						resultSet.getInt("post_type_id")

				);

				mposts.add(mp);
			}

			return mposts;
		}


	}

	public HashMap<String, String> addMentorPost(Post post)
			throws Exception
	{

		SimpleJdbcInsert simpleJdbcInsert = new SimpleJdbcInsert(this.masterJdbcTemplate).withTableName("posts").usingGeneratedKeyColumns(new String[] { "id" }).usingColumns(new String[] { "postby_id", "postto_id", "wall_type", "is_private", "post_type_id", "vertical_id", "title", "status", "link" });

		Map<String, Object> testInsertMap = Maps.newHashMap();
		testInsertMap.put("postby_id", "" + post.getPostby_id() + "");
		testInsertMap.put("postto_id", "" + post.getPostto_id() + "");
		testInsertMap.put("wall_type", "" + post.getWall_type() + "");
		testInsertMap.put("is_private", "" + post.isPrivate() + "");
		testInsertMap.put("post_type_id", "" + post.getPost_type_id() + "");
		testInsertMap.put("vertical_id", "" + post.getVertical_id() + "");
		testInsertMap.put("title", "" + post.getTitle() + "");
		testInsertMap.put("status", "" + post.getStatus() + "");
		testInsertMap.put("link", "" + post.getLink() + "");

		HashMap<String, String> status = new HashMap();
		status.put("success", "0");
		try
		{
			Number newId = simpleJdbcInsert.executeAndReturnKey(testInsertMap);
			logger.info("success = " + newId.longValue());

			status.put("success", "1");
			status.put("post_id", "" + newId.longValue());
			HashMap<String, String> localHashMap1 = status;

		}
		catch (Exception e)
		{
			logger.error("error in posting "+e);


		}

		return status;
	}

}
