package com.tecsolvent.wizspeak;

import com.google.common.collect.Maps;
import com.tecsolvent.wizspeak.model.*;
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
public class MentorDao {


	public static Logger logger = Logger.getLogger(MentorDao.class);

	private JdbcTemplate masterJdbcTemplate;
	private JdbcTemplate slaveJdbcTemplate;


	public void setMasterJdbcTemplate(JdbcTemplate masterJdbcTemplate) {
		this.masterJdbcTemplate = masterJdbcTemplate;
	}

	public void setSlaveJdbcTemplate(JdbcTemplate slaveJdbcTemplate) {
		this.slaveJdbcTemplate = slaveJdbcTemplate;
	}


	public ArrayList<Long> getUserMentors(long user_id) throws Exception {

		ArrayList<Long> mentors = new ArrayList<>();
		try {
			mentors = slaveJdbcTemplate.query("SELECT mentor_id FROM user_mentor_followers WHERE user_id = " + user_id + " AND status = 1", new MentorMapper());

		} catch (Exception e) {
			logger.error("error  getting mentor " + e);

		}

		return mentors;

	}


	private class MentorMapper implements ResultSetExtractor<ArrayList<Long>> {

		public ArrayList<Long> extractData(ResultSet resultSet) throws SQLException {

			ArrayList<Long> mentors = new ArrayList<Long>();
			while (resultSet.next()) {


				long mentor_id = Long.parseLong(resultSet.getString("mentor_id"));
				mentors.add(mentor_id);

			}

			return mentors;
		}


	}


	public ArrayList<Long> getMentorFollowers(long user_id) throws Exception {

		ArrayList<Long> fmentors = new ArrayList<>();
		try {
			fmentors = slaveJdbcTemplate.query("select user_id from user_mentor_followers where mentor_id = " + user_id + " AND status = 1 ", new getMentorFollowersMapper());

		} catch (Exception e) {

			logger.error(" getting friend id error " + e);
		}
		return fmentors;
	}


	private class getMentorFollowersMapper implements ResultSetExtractor<ArrayList<Long>> {

		public ArrayList<Long> extractData(ResultSet resultSet) throws SQLException {

			ArrayList<Long> mentor = new ArrayList<Long>();
			while (resultSet.next()) {

				logger.info("while userid =" + resultSet.getLong("user_id"));

				long friend_id = resultSet.getLong("user_id");
				mentor.add(friend_id);

			}

			return mentor;
		}


	}


	public Map<String, Object> mentorStatus(Mentor post) throws SQLException {


		Map<String, Object> p = new HashMap<>();
		String SQL = "UPDATE user_profile_status SET  status =?, is_mentor = ? WHERE user_id = ?";

		slaveJdbcTemplate.update(SQL, post.getStatus(), post.getMentor_id(), post.getUser_id());
		p.put("success", "1");
		logger.error("updated  mentor status");


		return p;
	}

	public Map<String, Object> editmentorExperience(Mentor post) throws SQLException {


		Map<String, Object> p = new HashMap<>();
		String SQL = "UPDATE user_works SET  company =?,jobtitle =?, date_from = ?,date_to = ? WHERE user_id = ? AND id =? ";

		slaveJdbcTemplate.update(SQL, post.getCompany(), post.getJobtitle(), post.getDate_from(), post.getDate_to(), post.getUser_id(), post.getId());
		p.put("success", "1");
		logger.error("updated  mentor expe ");
		logger.info((post.getDate_from()));
		logger.info((post.getCompany()));


		return p;
	}


	public Map<String, Object> addmentorExperience(Mentor post) throws SQLException {


		Map<String, Object> p = new HashMap<>();
		String SQL = "INSERT user_works SET  company =?,jobtitle =?, date_from = ?,date_to = ? ,user_id = ?";

		slaveJdbcTemplate.update(SQL, post.getCompany(), post.getJobtitle(), post.getDate_from(), post.getDate_to(), post.getUser_id());
		p.put("success", "1");
		logger.error("updated  add mentor  ");
		logger.info((post.getDate_from()));
		logger.info((post.getCompany()));


		return p;
	}

	public Map<String, Object> addMentorEducation(UserEducation post) throws SQLException {


		Map<String, Object> p = new HashMap<>();
		String SQL = "INSERT user_educations SET  user_id =?,education =?, institute = ?,university = ? ,date_from = ?,date_to = ?";

		slaveJdbcTemplate.update(SQL, post.getUser_id(), post.getEducation(), post.getInstitute(), post.getUniversity(), post.getDate_from(), post.getDate_to());
		p.put("success", "1");
		logger.error("updated  add edu metor  ");


		return p;
	}


	public Map<String, Object> editMentorEducation(UserEducation post) throws SQLException {


		Map<String, Object> p = new HashMap<>();
		String SQL = "UPDATE user_educations SET  education =?, institute = ?,university = ? ,date_from = ?,date_to = ? WHERE user_id = ? AND id =?";

		slaveJdbcTemplate.update(SQL, post.getEducation(), post.getInstitute(), post.getUniversity(), post.getDate_from(), post.getDate_to(), post.getUser_id(), post
				.getId());
		p.put("success", "1");
		logger.error("updated  add edu metor  ");


		return p;
	}

	public Map<String, Object> deleteMentorEducation(UserEducation post) throws SQLException {


		Map<String, Object> p = new HashMap<>();
		String SQL = "DELETE FROM  user_educations  WHERE user_id = ? AND id =?";

		slaveJdbcTemplate.update(SQL, post.getUser_id(), post.getId());
		p.put("success", "1");
		logger.error("updated  add edu metor  ");


		return p;
	}


	public Map<String, Object> editAward(Award post) throws SQLException {


		Map<String, Object> p = new HashMap<>();
		String SQL = "UPDATE user_awards SET  award =?,authority =?, date_awarded = ? WHERE user_id = ? AND id = ?  ";

		slaveJdbcTemplate.update(SQL, post.getAward(), post.getAuthority(), post.getDate_awarded(), post.getUser_id(), post.getId());
		p.put("success", "1");
		logger.info(post.getAward());
		logger.info(post.getAuthority());
		logger.info("mentor u id" + post.getUser_id());
		logger.info("mentor u id" + post.getId());


		logger.error("edit errorrrrrrrrrr  add mentor  ");
		return p;
	}


	public Map<String, Object> removementorExperience(Mentor post) throws SQLException {


		Map<String, Object> p = new HashMap<>();
		String SQL = "DELETE FROM user_works  WHERE user_id = ? AND id = ? ";

		slaveJdbcTemplate.update(SQL, post.getUser_id(), post.getId());
		p.put("success", "1");
		logger.error("updated remove ment exp  ");


		return p;
	}

	public Map<String, Object> deleteAward(Award post) throws SQLException {


		Map<String, Object> p = new HashMap<>();
		String SQL = "DELETE FROM user_awards  WHERE user_id = ? AND id = ? ";

		slaveJdbcTemplate.update(SQL, post.getUser_id(), post.getId());
		p.put("success", "1");
		logger.error("updated remove ment exp  ");

		return p;
	}


	public List<Award> getAward(int user_id) throws Exception {
		try {

			return slaveJdbcTemplate.query("SELECT  Award.id,Award.user_id, Award.award, Award.authority, Award.date_awarded FROM user_awards AS Award WHERE Award.user_id = " + user_id, new awardMapper());
		} catch (Exception e) {
			throw e;
		}
	}


	public List<Certification> getCert(int user_id) throws Exception {
		try {

			return slaveJdbcTemplate.query("SELECT  id,certification,user_id, authority,date_certified FROM user_certifications WHERE user_id = " + user_id, new certMapper());
		} catch (Exception e) {
			throw e;
		}
	}


	private class certMapper implements ResultSetExtractor<List<Certification>> {
		public List<Certification> extractData(ResultSet resultSet) throws SQLException {


			List<Certification> userexp = new ArrayList<Certification>();

			while (resultSet.next()) {


				Certification userObject = new Certification(resultSet.getLong("id"), resultSet.getInt("user_id"), resultSet.getString("certification"), resultSet.getString("authority"), resultSet.getString("date_certified"));
				userexp.add(userObject);


			}


			return userexp;

		}
	}

	public Map<String, Object> addAward(Award post) throws SQLException {


		Map<String, Object> p = new HashMap<>();
		String SQL = "INSERT user_awards SET  award =?,authority =?, date_awarded = ? ,user_id = ?";

		slaveJdbcTemplate.update(SQL, post.getAward(), post.getAuthority(), post.getDate_awarded(), post.getUser_id());
		p.put("success", "1");


		return p;
	}


	public Map<String, Object> addCert(Certification post) throws SQLException {


		Map<String, Object> p = new HashMap<>();
		String SQL = "INSERT user_certifications SET  authority =?, certification =?, date_certified = ? ,user_id = ?";

		slaveJdbcTemplate.update(SQL, post.getAuthority(), post.getCertification(), post.getDate_certified(), post.getUser_id());
		p.put("success", "1");

		return p;
	}


	public Map<String, Object> editCert(Certification post) throws SQLException {


		Map<String, Object> p = new HashMap<>();
		String SQL = "UPDATE user_certifications SET  authority =?, certification =?, date_certified = ? WHERE user_id = ? AND id= ?";

		slaveJdbcTemplate.update(SQL, post.getAuthority(), post.getCertification(), post.getDate_certified(), post.getUser_id(), post.getId());
		p.put("success", "1");

		return p;
	}


	public Map<String, Object> deleteCert(Certification post) throws SQLException {


		Map<String, Object> p = new HashMap<>();
		String SQL = "DELETE FROM user_certifications  WHERE user_id = ? AND id = ? ";

		slaveJdbcTemplate.update(SQL, post.getUser_id(), post.getId());
		p.put("success", "1");
		logger.error("updated remove ment exp  ");

		return p;
	}


	private class awardMapper implements ResultSetExtractor<List<Award>> {
		public List<Award> extractData(ResultSet resultSet) throws SQLException {


			List<Award> userexp = new ArrayList<Award>();

			while (resultSet.next()) {


				Award userObject = new Award(resultSet.getLong("id"), resultSet.getInt("user_id"), resultSet.getString("award"), resultSet.getString("authority"), resultSet.getString("date_awarded"));
				userexp.add(userObject);


			}


			return userexp;

		}
	}


	public Map<String, Object> reFollow(MentorFollow follow) throws SQLException {

		java.util.Date dt = new java.util.Date();
		java.text.SimpleDateFormat sdf = new java.text.SimpleDateFormat("yyyy-MM-dd HH:mm:ss");

		String currentTime = sdf.format(dt);

		Map<String, Object> p = new HashMap<>();
		String SQL = "UPDATE user_mentor_followers SET   status = ?,date_updated = ? WHERE user_id = ? AND mentor_id =? ";

		slaveJdbcTemplate.update(SQL, 1, currentTime, follow.getUser_id("user_id"), follow.getMentor_id("mentor_id"));
		p.put("success", "1");
		logger.error("updated  mentor expe ");

		logger.info((follow.getMentor_id("mentor_id")));


		return p;
	}


	public Map<String, Object> addFollow(MentorFollow follow) throws SQLException

	{

		java.util.Date dt = new java.util.Date();
		java.text.SimpleDateFormat sdf = new java.text.SimpleDateFormat("yyyy-MM-dd HH:mm:ss");

		String currentTime = sdf.format(dt);


		SimpleJdbcInsert simpleJdbcInsert = new SimpleJdbcInsert(slaveJdbcTemplate).withTableName("user_mentor_followers").usingColumns("user_id", "mentor_id", "status", "date_updated");

		Map<String, Object> followw = Maps.newHashMap();
		followw.put("user_id", follow.getUser_id("user_id"));
		followw.put("mentor_id", follow.getMentor_id("mentor_id"));
		followw.put("status", "1");
		followw.put("date_updated", currentTime);


		try {

			simpleJdbcInsert.execute(followw);
		} catch (Exception e) {
			logger.error("error in addd new foloow " + e);
			logger.info((followw));

		}
		return followw;

	}


	public Map<String, Object> unFollow(MentorFollow unfollow) throws SQLException {

		java.util.Date dt = new java.util.Date();
		java.text.SimpleDateFormat sdf = new java.text.SimpleDateFormat("yyyy-MM-dd HH:mm:ss");

		String currentTime = sdf.format(dt);

		Map<String, Object> p = new HashMap<>();
		String SQL = "UPDATE user_mentor_followers SET   status = ?,date_updated = ? WHERE user_id = ? AND mentor_id =? ";

		slaveJdbcTemplate.update(SQL, 0, currentTime, unfollow.getUser_id("user_id"), unfollow.getMentor_id("mentor_id"));
		p.put("success", "1");
		logger.error("updated  mentor expe ");

		logger.info((unfollow.getMentor_id("mentor_id")));


		return p;
	}

	public List<MentorFollow> followCheck(long user_id) throws Exception {
		try {

			return slaveJdbcTemplate.query("SELECT  id, mentor_id, user_id, status FROM user_mentor_followers  WHERE user_id =  " + user_id + " AND status = 0 ", new followcheckMapper());
		} catch (Exception e) {
			throw e;
		}
	}


	public List<MentorRate> checkMentorRating(long user_id) throws Exception {
		try {

			return slaveJdbcTemplate.query("SELECT  id, mentor_id, user_id, rating,date_rated FROM user_mentor_ratings  WHERE user_id =  " + user_id, new checkRatingMapper());
		} catch (Exception e) {
			throw e;
		}
	}


	private class followcheckMapper implements ResultSetExtractor<List<MentorFollow>> {
		public List<MentorFollow> extractData(ResultSet resultSet) throws SQLException {


			List<MentorFollow> userfchk = new ArrayList<MentorFollow>();

			while (resultSet.next()) {


				MentorFollow userObject = new MentorFollow(resultSet.getLong("id"), resultSet.getInt("user_id"), resultSet.getInt("mentor_id"), resultSet.getString("status"));
				userfchk.add(userObject);
				logger.info((resultSet.getLong("id")));
				logger.info((resultSet.getLong("user_id")));
				logger.info((resultSet.getLong("mentor_id")));


			}


			return userfchk;

		}
	}

	private class checkRatingMapper implements ResultSetExtractor<List<MentorRate>> {
		public List<MentorRate> extractData(ResultSet resultSet) throws SQLException {


			List<MentorRate> userfchk = new ArrayList<MentorRate>();

			while (resultSet.next()) {


				MentorRate userObject = new MentorRate(resultSet.getLong("id"), resultSet.getInt("user_id"), resultSet.getInt("mentor_id"), resultSet.getString("rating"), resultSet.getString("date_rated"));
				userfchk.add(userObject);


			}


			return userfchk;

		}
	}




	public Map<String, Object> addRating(MentorRate follow) throws SQLException{

		java.util.Date dt = new java.util.Date();
		java.text.SimpleDateFormat sdf = new java.text.SimpleDateFormat("yyyy-MM-dd HH:mm:ss");

		String currentTime = sdf.format(dt);
		Map<String, Object> p = new HashMap<>();
		String SQL = "INSERT user_mentor_ratings SET  user_id =?, mentor_id =?, rating = ? ,date_rated = ?";

		slaveJdbcTemplate.update(SQL, follow.getUser_id("user_id"), follow.getMentor_id("mentor_id"), follow.getRating("rating"), currentTime );
		p.put("success", "1");

		return p;
	}

	public Map<String, Object> reRating(MentorRate follow) throws SQLException{

		java.util.Date dt = new java.util.Date();
		java.text.SimpleDateFormat sdf = new java.text.SimpleDateFormat("yyyy-MM-dd HH:mm:ss");

		String currentTime = sdf.format(dt);
		Map<String, Object> p = new HashMap<>();
		String SQL = "UPDATE user_mentor_ratings SET   rating = ? ,date_rated = ? WHERE user_id = ? AND mentor_id =?";


		slaveJdbcTemplate.update(SQL,  follow.getRating("rating"), currentTime, follow.getUser_id("user_id"), follow.getMentor_id("mentor_id"));
		p.put("success", "1");

		return p;
	}


}
