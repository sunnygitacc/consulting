package com.tecsolvent.wizspeak.service;

import com.tecsolvent.wizspeak.UserDao;
import com.tecsolvent.wizspeak.cache.GuavaAndCouchbaseCache;
import com.tecsolvent.wizspeak.model.User;
import org.apache.log4j.Logger;

/**
 * Created by jaison on 16/3/16.
 */
public class UserService {

	private UserDao userDao;
	private GuavaAndCouchbaseCache guavaAndCouchbaseCache;
	public static Logger logger = Logger.getLogger(GroupService.class);


	public void setUserDao(UserDao userDao){ this.userDao = userDao; }


	public void setGuavaAndCouchbaseCache(GuavaAndCouchbaseCache guavaAndCouchbaseCache) {
		this.guavaAndCouchbaseCache = guavaAndCouchbaseCache;
	}


	public User getUserName(long user_id) throws Exception {

		User user = (User) guavaAndCouchbaseCache.getObjectFromCache("userNamesa"+user_id,User.class);

		if(user == null){

			logger.info(" name fetching from mysql direct");
			user = userDao.getUserName(user_id);
			guavaAndCouchbaseCache.putObjectAsByteInCache("userName"+user_id, user);
		}else{

			logger.info("name fetching from cache");
		}

		return user;

	}


	public String getUserStatus(long user_id) throws Exception {

		String status = (String) guavaAndCouchbaseCache.getObjectFromCache("userStatus1"+user_id,String.class);
		if(status == null){
			logger.info(" status fetching from mysql direct");
			status = userDao.getUserStatus(user_id);
			if(status == null){ status=" ";}
			guavaAndCouchbaseCache.putObjectAsByteInCache("userStatus"+user_id, status);
		}else{

			logger.info("status fetching from cache");
		}

		return status;
	}


	public String getUserPic(long user_id) throws Exception {

		String profilePic = (String) guavaAndCouchbaseCache.getObjectFromCache("profilePic"+user_id,String.class);
		if(profilePic == null){
			logger.info(" status fetching from mysql direct");
			profilePic = userDao.getUserPic(user_id,1,1);
			if(profilePic == null){ profilePic=" ";}
			guavaAndCouchbaseCache.putObjectAsByteInCache("userProfilePic"+user_id, profilePic);
		}else{

			//System.out.println("status fetching from cache");
		}

		return profilePic;
	}



	public User userDetails(long user_id) throws Exception {

		User user = getUserName(user_id);
		String status = getUserStatus(user_id);
		String profilePic  = getUserPic(user_id);

		user.setProfileStatus(status);
		user.setProfilePic(profilePic);

		return user;
	}

}
