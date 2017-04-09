package com.tecsolvent.wizspeak.service;

import com.tecsolvent.wizspeak.MentorDao;
import com.tecsolvent.wizspeak.UserDao;
import com.tecsolvent.wizspeak.cache.GuavaAndCouchbaseCache;
import com.tecsolvent.wizspeak.model.User;
import org.apache.log4j.Logger;

import java.util.ArrayList;
import java.util.Iterator;

/**
 * Created by jaison on 20/3/16.
 */
public class MentorService {


	private UserDao userDao;
	private MentorDao mentorDao;
	private GuavaAndCouchbaseCache guavaAndCouchbaseCache;
	public static Logger logger = Logger.getLogger(MentorService.class);

	public void setUserDao(UserDao userDao){ this.userDao = userDao; }

	public void setMentorDao(MentorDao mentorDao) {
		this.mentorDao = mentorDao;
	}

	public void setGuavaAndCouchbaseCache(GuavaAndCouchbaseCache guavaAndCouchbaseCache) {
		this.guavaAndCouchbaseCache = guavaAndCouchbaseCache;
	}


	public ArrayList<User> getUserMentors(long user_id) throws Exception{



		ArrayList<User> uMentors = (ArrayList<User>) guavaAndCouchbaseCache.getObjectFromCache("userMentorst"+user_id,ArrayList.class);

		if(uMentors!=null){
			logger.info("from Cache");
			return uMentors;
		}
		logger.info("from mysql diret");
		ArrayList<Long> mentorIds = mentorDao.getUserMentors(user_id);
		ArrayList<User> mentors = new ArrayList<User>();

		Iterator itr = mentorIds.iterator();

		while (itr.hasNext()){

			User user = new User();

			user = userDao.getUserName((Long) itr.next());
			mentors.add(user);
		}
		guavaAndCouchbaseCache.putObjectAsByteInCache("userMentors"+user_id, mentors);

		return mentors;
	}



}
