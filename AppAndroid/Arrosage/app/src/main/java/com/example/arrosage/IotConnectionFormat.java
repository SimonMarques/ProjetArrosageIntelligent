package com.example.arrosage;

import android.os.AsyncTask;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.FileOutputStream;
import java.io.FileWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.io.Writer;
import java.net.HttpURLConnection;
import java.net.URL;

public class IotConnectionFormat extends AsyncTask {

    private String url;
    public IotConnectionFormat(){

    }
    public IotConnectionFormat( String url){
        this.url = url;
    }
    @Override
    protected Object doInBackground(Object[] objects) {

        String lineAll = new String();
        URL url = null;
        try {
            url = new URL(getUrl());
            HttpURLConnection myHttpCon = (HttpURLConnection) url.openConnection();
            InputStream myInputStream = myHttpCon.getInputStream();

            InputStreamReader myInStreamReader = new InputStreamReader(myInputStream);
            BufferedReader myBufferReader = new BufferedReader(myInStreamReader);

            String line ;
            while ((line = myBufferReader.readLine()) != null) {
                lineAll += line;
            }
            myBufferReader.close();
            myHttpCon.disconnect();
        } catch (IOException e) {
            e.printStackTrace();
        }
        return lineAll;
    }
    public String getUrl() {
        return url;
    }

    public void setUrl(String url) {
        this.url = url;
    }
}
