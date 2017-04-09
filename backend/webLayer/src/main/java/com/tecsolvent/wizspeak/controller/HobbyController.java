package com.tecsolvent.wizspeak.controller;

import com.fasterxml.jackson.databind.ObjectMapper;
import com.fasterxml.jackson.databind.ObjectWriter;
import com.tecsolvent.wizspeak.model.Category;
import com.tecsolvent.wizspeak.service.HobbyService;
import org.apache.log4j.Logger;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.ResponseBody;

import javax.annotation.Resource;
import java.util.ArrayList;

/**
 * Created by jaison on 16/3/16.
 */
@Controller
public class HobbyController  {

	public static Logger logger = Logger.getLogger(HobbyController.class);
	@Resource(name = "hobbyService")
	HobbyService hobbyService;


	@RequestMapping(value="/getHobbyCategories", method = RequestMethod.GET)
	public
	@ResponseBody
	String getHobbyCategories() throws Exception {
		ArrayList<Category> categories  = new ArrayList<>();
		categories = hobbyService.getCategories(2);
		logger.info("inside ambition Contoller");
		ObjectWriter ow = new ObjectMapper().writer().withDefaultPrettyPrinter();
		String json = ow.writeValueAsString(categories);


		return json;
	}

	@RequestMapping(value = "/myHobby", method = RequestMethod.GET)
	public
	@ResponseBody
	String myHobby() throws Exception{

		return "success";
	}



}
