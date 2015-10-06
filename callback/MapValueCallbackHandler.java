package com.aurospaces.neighbourhood.db.callback;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.LinkedHashMap;
import java.util.List;
import java.util.Map;

import org.springframework.jdbc.core.RowCallbackHandler;

/*
CHIDDU workaround  , instead of querying the ResultSet repeatedly for
the columns, am just taking an Array of String as the column names to query for,
and the key by which each map has to be grouped together.
*/
public class MapValueCallbackHandler implements RowCallbackHandler
{
	Map<String,Map<String,String>>  retList;
	String keyColumn;
	String[] columnsToQuery;

	public MapValueCallbackHandler(String keyColumn, String[] columnsToQuery)
	{
		this.keyColumn = keyColumn;
		this.columnsToQuery = columnsToQuery;

		/* Linked Hash map to preserve the order during iteration - Chiddu */
		retList = new LinkedHashMap<String,Map<String,String>>(); 
	}

	public Map<String,Map<String,String>>  getResult()
	{
		return retList;
	}

	
	public void processRow(ResultSet rs) throws SQLException 
	{
		
		Map<String,String> eachRow = new HashMap<String,String>();
		String keyValue = null;
		for(String column : columnsToQuery)
		{
			String value  = rs.getString(column);
			eachRow.put(column,value);
			if(column.equals(keyColumn))
			{
				retList.put(value, eachRow);
			}
		}
	}
	
}
