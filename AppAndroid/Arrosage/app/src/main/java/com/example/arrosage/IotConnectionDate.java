package com.example.arrosage;

import android.os.AsyncTask;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.URL;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Date;

public class IotConnectionDate extends AsyncTask {


    private String idVanne;

    public IotConnectionDate(String idVanne){
        this.idVanne = idVanne;
    }

    @Override
    protected Object doInBackground(Object[] objects) {

        String lineAll = new String();
        URL url = null;

        DateFormat format = new SimpleDateFormat("yyyy-MM-dd");
        Date date = new Date();
        System.out.println(format.format(date));

        try {
            url = new URL("http://projet18.ddns.net:44480/Json/Json_Date/Vanne"+idVanne+"_"+format.format(date)+".json");
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
    public String getIdVanne() {
        return idVanne;
    }

    public void setIdVanne(String idVanne) {
        this.idVanne = idVanne;
    }
}
