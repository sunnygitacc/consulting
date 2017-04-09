package com.tecsolvent.wizspeak;

import com.google.common.collect.Maps;
import com.tecsolvent.wizspeak.model.Experience;
import com.tecsolvent.wizspeak.model.Post;
import com.tecsolvent.wizspeak.model.User;
import com.tecsolvent.wizspeak.model.UserEducation;
import org.apache.log4j.Logger;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.jdbc.core.ResultSetExtractor;
import org.springframework.jdbc.core.simple.SimpleJdbcInsert;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

/**
 * Created by jaison on 16/3/16.
 */
public class UserDao {


	public static Logger logger = Logger.getLogger(UserDao.class);

	private JdbcTemplate masterJdbcTemplate;
	private JdbcTemplate slaveJdbcTemplate;


	public void setMasterJdbcTemplate(JdbcTemplate masterJdbcTemplate) {
		this.masterJdbcTemplate = masterJdbcTemplate;
	}

	public void setSlaveJdbcTemplate(JdbcTemplate slaveJdbcTemplate) {
		this.slaveJdbcTemplate = slaveJdbcTemplate;
	}




	public User getUserName(long user_id) throws Exception {

		User user = new User();
		try {
logger.info("userDao");

			user = slaveJdbcTemplate.query("select id,first_name,last_name,userId,email,city,state,country,dob from users where id = "+user_id , new IdMapper());
		} catch( Exception e) {
			logger.error("Error in getting user name "+e);

		}

		return user;
	}


	private class IdMapper implements ResultSetExtractor<User> {
		public User extractData(ResultSet resultSet) throws SQLException {

			resultSet.next();
			User user = new User(Long.parseLong(resultSet.getString("id")),resultSet.getInt("city"),resultSet.getInt("state"),resultSet.getInt("country"),resultSet.getString("first_name"),resultSet.getString("last_name"),resultSet.getString("email"),resultSet.getString("userId"),resultSet.getString("dob"));

			return user;
		}
	}


	public String getUserStatus(long user_id) throws Exception {
		String status = "";
		try {
			status = slaveJdbcTemplate.query("select status from user_profile_status where id = "+user_id+" ", new StatusMapper());
		} catch( Exception e) {
			logger.error("Error in getting user status"+ e);

		}

		return status;
	}

	private class StatusMapper implements ResultSetExtractor<String> {
		public String extractData(ResultSet resultSet) throws SQLException {

			resultSet.next();
			return resultSet.getString("status");
		}
	}


	public String getUserPic(long wallId, int wallType, int picType) throws Exception {

		String pic ="";
		try {
			pic  = slaveJdbcTemplate.query("select link from user_group_profile_pics where wall_id = "+wallId+" AND wall_type = "+wallType+" AND is_avatar = "+picType+" AND is_active = 1 ", new UserPicMapper());
		} catch( Exception e) {
			logger.error("Error in getting profile pic "+e);
		}
		return pic;
	}

	private class UserPicMapper implements ResultSetExtractor<String> {
		public String extractData(ResultSet resultSet) throws SQLException {

			resultSet.next();
			return resultSet.getString("link");
		}
	}


	public boolean addCustomUrl(Map<String,Object> newUrlName)throws  Exception{

		SimpleJdbcInsert simpleJdbcInsert = new SimpleJdbcInsert(this.masterJdbcTemplate).withTableName("url_custom_name").usingColumns(new String[] { "wall_id", "wall_type", "name", "status", "date_created" });
		boolean status =false;
		try {
			simpleJdbcInsert.execute(newUrlName);
			status = true;
		}catch (Exception e){
			logger.error("adding new custom url name");
		}

		return status;
	}

	public List<UserEducation> getUserProfileEducation(int user_id) throws Exception {
		try {

			return slaveJdbcTemplate.query("SELECT UserEducation.id, UserEducation.user_id, UserEducation.education, UserEducation.institute, UserEducation.university, UserEducation.date_from, UserEducation.date_to FROM user_educations AS UserEducation WHERE UserEducation.user_id = "+user_id , new UserEducationDataMapper());
		} catch (Exception e) {
			throw e;
		}
	}

	public List<Experience> getUserExperience(int user_id) throws Exception {
		try {

			return slaveJdbcTemplate.query("SELECT  UserWork.id,UserWork.user_id, UserWork.company, UserWork.jobtitle, UserWork.date_from, UserWork.date_to FROM user_works AS UserWork WHERE UserWork.user_id = "+user_id , new UserExperienceDataMapper());
		} catch (Exception e) {
			throw e;
		}
	}

	public boolean removeCustomUrl(long urlId)throws  Exception{

		String SQL = "UPDATE url_custom_name SET status = ?  WHERE id = ?";
		try {
			slaveJdbcTemplate.update(SQL, 0, urlId);
		}catch (Exception e){

			logger.error("removed custom url"+e);
		}

		return  false;
	}

	public boolean updateCustomUrl(long urlId,String name) throws Exception{

		String SQL = "UPDATE url_custom_name SET name = ? , status = ?  WHERE id = ?";
		try {
			slaveJdbcTemplate.update(SQL, name, 1, urlId);
		}catch (Exception e){

			logger.error("removed custom url"+e);
		}

		return  false;
	}

	public String getCustomUrl(long wallId,int wallType) throws Exception{

			String url = "";

		try {
			url = slaveJdbcTemplate.query("select name from url_custom_name where wall_id = "+wallId+" AND wall_type ="+wallType, new CustomUrlMapper());
		} catch( Exception e) {
			logger.error("Error in getting user status"+ e);
			throw e;
		}
		return url;
	}

	public class CustomUrlMapper implements ResultSetExtractor<String> {
		public String extractData(ResultSet resultSet) throws SQLException {

			resultSet.next();
			return resultSet.getString("name");
		}
	}

	public Long getWallId(String customUrl,int wallType) throws Exception{

		long wall_id;

		try {
			wall_id = slaveJdbcTemplate.query("select wall_id from url_custom_name where name = '"+customUrl+"' AND  wall_type ="+wallType, new WallIdMapper());
		} catch(Exception e) {
			logger.error("Error in getting wall_id"+ e);
			throw e;
		}
		return wall_id;
	}

	public class WallIdMapper implements ResultSetExtractor<Long> {
		public Long extractData(ResultSet resultSet) throws SQLException {

			resultSet.next();
			return resultSet.getLong("wall_id");
		}
	}

	private class UserEducationDataMapper implements ResultSetExtractor<List<UserEducation>> {
		public List<UserEducation> extractData(ResultSet resultSet) throws SQLException {


			List<UserEducation> usereducation = new ArrayList<UserEducation>();

			while (resultSet.next()) {


				UserEducation userObject = new UserEducation(resultSet.getLong("id"), resultSet.getInt("user_id"), resultSet.getString("education"), resultSet.getString("institute"), resultSet.getString("university"), resultSet.getString("date_from"), resultSet.getString("date_to"));
				usereducation.add(userObject);


			}


			return usereducation;

		}
	}

	private class UserExperienceDataMapper implements ResultSetExtractor<List<Experience>> {
		public List<Experience> extractData(ResultSet resultSet) throws SQLException {


			List<Experience> userexp = new ArrayList<Experience>();

			while (resultSet.next()) {


				Experience userObject = new Experience( resultSet.getLong("id"),resultSet.getInt("user_id"), resultSet.getString("company"), resultSet.getString("jobtitle"), resultSet.getString("date_from"), resultSet.getString("date_to"));
				userexp.add(userObject);


			}


			return userexp;

		}
	}


	public Map<String,Object> userProfileEducationMapper(UserEducation usereducation) throws SQLException {

		java.util.Date dt = new java.util.Date();
		java.text.SimpleDateFormat sdf = new java.text.SimpleDateFormat("yyyy-MM-dd HH:mm:ss");

		String currentTime = sdf.format(dt);

		Map<String,Object> p = new HashMap<>();
		String SQL = "UPDATE user_educations SET education = ? ,institute = ? ,university = ? ,date_from = ? , date_to =? WHERE id = ?";

		slaveJdbcTemplate.update(SQL, usereducation.getEducation(),usereducation.getInstitute(),usereducation.getUniversity(),usereducation.getDate_from(),usereducation.getDate_to() ,usereducation.getId());
		p.put("success","1");
		logger.error("updated  education  profile");



		return p;
	}

	public String updateUserEducation(UserEducation updateObject) throws Exception {


		SimpleJdbcInsert simpleJdbcInsert = new SimpleJdbcInsert(masterJdbcTemplate).withTableName("user_educations")
				.usingColumns("user_id","education", "institute", "university", "date_from", "date_to");
		Map<String, Object> updateUserEducation = Maps.newHashMap();
		updateUserEducation.put("user_id", updateObject.getId());
		updateUserEducation.put("education",   updateObject.getEducation() );
		updateUserEducation.put("institute",  updateObject.getInstitute() );
		updateUserEducation.put("university", updateObject.getUniversity());
		updateUserEducation.put("date_from",   updateObject.getDate_from());
		updateUserEducation.put("date_to",   updateObject.getDate_to() );



		try {

			logger.debug("data - " + updateUserEducation );

			simpleJdbcInsert.execute(updateUserEducation);
		} catch (Exception e) {

			throw e;


		} finally {
			return "success";
		}

	}
}
