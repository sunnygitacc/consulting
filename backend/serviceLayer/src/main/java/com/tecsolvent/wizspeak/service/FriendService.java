package com.tecsolvent.wizspeak.service;

import com.tecsolvent.wizspeak.FriendDao;
import com.tecsolvent.wizspeak.UserDao;
import com.tecsolvent.wizspeak.cache.GuavaAndCouchbaseCache;
import com.tecsolvent.wizspeak.model.User;
import org.apache.log4j.Logger;

import java.util.ArrayList;
import java.util.Iterator;

/**
 * Created by jaison on 18/3/16.
 */
public class FriendService {

	private FriendDao friendDao;
	private UserDao userDao;
	private GuavaAndCouchbaseCache guavaAndCouchbaseCache;
	public static Logger logger = Logger.getLogger(FriendService.class);


	public void setGuavaAndCouchbaseCache(GuavaAndCouchbaseCache guavaAndCouchbaseCache) {
		this.guavaAndCouchbaseCache = guavaAndCouchbaseCache;
	}

	public void setFriendDao(FriendDao friendDao) {
		this.friendDao = friendDao;
	}

	public void setUserDao(UserDao userDao) {
		this.userDao = userDao;
	}

	public ArrayList<User> getUserFriends(long user_id) throws Exception{


		ArrayList<User> uFriend = (ArrayList<User>) guavaAndCouchbaseCache.getObjectFromCache("userFriends"+user_id,ArrayList.class);
		if(uFriend!=null){
			//System.out.println("from frinds cache  ");
			return uFriend;
		}
		ArrayList<Long> frinds = new ArrayList<>();
		try {
			frinds = friendDao.getUserFriends(user_id);
		}catch (Exception e){

			logger.info("error in getting friendDao"+e);
		}
		ArrayList<User> myFriends = new ArrayList<User>();

		Iterator<Long> itr = frinds.iterator();

		while (itr.hasNext()){

			User user = new User();

			user = userDao.getUserName(itr.next());
			myFriends.add(user);
		}

		guavaAndCouchbaseCache.putObjectAsByteInCache("userFriends"+user_id, myFriends);

		return myFriends;
	}


	public String checkAccess()throws Exception{

try {
	friendDao.getUserFriends(1);
}catch (Exception e){
logger.info("error in getting friendsDao"+e);

}

		return "acess granted";
	}
}
