package com.tecsolvent.wizspeak.elasticsearch;

import org.elasticsearch.action.admin.indices.create.CreateIndexRequestBuilder;
import org.elasticsearch.action.admin.indices.exists.indices.IndicesExistsRequest;
import org.elasticsearch.action.admin.indices.exists.indices.IndicesExistsResponse;
import org.elasticsearch.client.Client;
import org.elasticsearch.client.transport.TransportClient;
import org.elasticsearch.common.settings.ImmutableSettings;
import org.elasticsearch.common.settings.Settings;
import org.elasticsearch.common.transport.InetSocketTransportAddress;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by gopu on 20/4/16.
 */


public class ESClient {

	public static final String MAPPING_JSON = "{\n" +
			"  \"mappings\": {\n" +
			"    \"_default_\": {\n" +
			"      \"dynamic_templates\": [\n" +
			"        {\n" +
			"          \"mapping\": {\n" +
			"            \"match\": \"*\",\n" +
			"            \"mapping\": {\n" +
			"              \"index\": \"not_analyzed\"\n" +
			"            }\n" +
			"          }\n" +
			"        }\n" +
			"      ]\n" +
			"    }\n" +
			"  }\n" +
			"}";
	private static final String CLUSTER_NAME = "cluster.name";
	private static final String CLIENT_TRANSPORT_SNIFF = "client.transport.sniff";
	private static final String CLIENT_TRANSPORT_NODES_SAMPLER_INTERVAL = "client.transport.nodes_sampler_interval";
	private static final String CLIENT_TRANSPORT_PING_TIMEOUT = "client.transport.ping_timeout";
	private static final String INDEX_MAPPER_DYNAMIC = "index.mapper.dynamic";
	private static final String ES_INDEX = "main";
	private static ESClient INSTANCE = null;
	private TransportClient client;

	private ESClient() {

		Settings settings = ImmutableSettings.settingsBuilder()
				.put(CLUSTER_NAME, "TestClusterName")
				.put(CLIENT_TRANSPORT_SNIFF, "true")
				.put(CLIENT_TRANSPORT_NODES_SAMPLER_INTERVAL, "60s")
				.put(CLIENT_TRANSPORT_PING_TIMEOUT, "60s")
				.put(INDEX_MAPPER_DYNAMIC, "true")
				.build();

		client = new TransportClient(settings);
		List<String> esClienthosts = new ArrayList<String>();

		esClienthosts.add("localhost");

		for (String host : esClienthosts) {
			client.addTransportAddress(new InetSocketTransportAddress(host, 9300));
		}

		IndicesExistsResponse existsResponse = client.admin().indices().exists(new IndicesExistsRequest()).actionGet();
		if (!existsResponse.isExists()) {
			CreateIndexRequestBuilder createIndexRequestBuilder = client.admin().indices().prepareCreate(ES_INDEX);
			createIndexRequestBuilder.setSource(MAPPING_JSON);
			createIndexRequestBuilder.execute().actionGet();
		}
		//TODO: some loggers here
	}

	public static ESClient getInstance() {
		if (INSTANCE == null) {
			synchronized (ESClient.class) {
				if (INSTANCE == null) {
					INSTANCE = new ESClient();
				}
			}
		}
		return INSTANCE;
	}

	public void shutdown() {
		client.close();
	}

	public Client getClient() {
		return client;
	}
}
