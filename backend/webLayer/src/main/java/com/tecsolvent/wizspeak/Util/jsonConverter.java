package com.tecsolvent.wizspeak.Util;


import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.fasterxml.jackson.databind.ObjectWriter;

/**
 * Created by gopu on 20/3/16.
 */
public class jsonConverter {


	public static String ObjectJson(Object object) throws JsonProcessingException {

		ObjectWriter ow = new ObjectMapper().writer().withDefaultPrettyPrinter();
		String json = ow.writeValueAsString(object);
		return json;
	}


}

