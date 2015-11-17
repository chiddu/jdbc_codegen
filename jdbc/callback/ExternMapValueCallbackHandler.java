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
public class ExternMapValueCallbackHandler implements RowCallbackHandler
{
	Map<String,Map<String,String>>  retList;
	String keyColumn;
	String[] columnsToQuery;

	public ExternMapValueCallbackHandler(String keyColumn, 
		String[] columnsToQuery,
		Map<String,Map<String,String>>  retList
		)
	{
		this.keyColumn = keyColumn;
		this.columnsToQuery = columnsToQuery;
		this.retList = retList;
		/* We just append to this external list */
	}

	/* This is redundant, since we use an external Map,
	the result is already available to the caller */
	public Map<String,Map<String,String>>  getResult()
	{
		return retList;
	}

	
	public void processRow(ResultSet rs) throws SQLException 
	{
		


		String value = rs.getString(keyColumn);
		Map<String,String> eachRow =retList.get(value);
		if(eachRow == null)
		{
			eachRow = new HashMap<String,String>();
			retList.put(value,eachRow);
		}

		String keyValue = null;
		for(String column : columnsToQuery)
		{
			value  = rs.getString(column);
			eachRow.put(column,value);
		}
	}
	
}
