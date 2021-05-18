package com.example.arrosage;

import android.os.AsyncTask;
import android.util.Log;

import com.google.gson.JsonObject;

import org.json.JSONObject;

import java.io.BufferedOutputStream;
import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.File;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLConnection;


public class IoTSendProgrammation extends AsyncTask {

    private String url;
    private String idVanne;
    private JSONObject jsonObj;

    public IoTSendProgrammation(){

    }

    public IoTSendProgrammation(String url, String idVanne, JSONObject jsonObj){

        this.idVanne = idVanne;
        this.url = url;
        this.jsonObj = jsonObj;
    }
    public IoTSendProgrammation(JSONObject jsonObj){
        this.jsonObj = jsonObj;
    }
    @Override
    protected Object doInBackground(Object[] objects) {

        HttpURLConnection urlConnection = null;

        try {

            JsonObject postData = new JsonObject();
            postData.addProperty("name", "morpheus");
            postData.addProperty("job", "leader");

            URL url = new URL("https://reqres.in/api/users");
            urlConnection = (HttpURLConnection) url.openConnection();
            urlConnection.setRequestProperty("Content-Type", "application/json");
            urlConnection.setRequestMethod("POST");
            urlConnection.setDoOutput(true);
            urlConnection.setDoInput(true);
            urlConnection.setChunkedStreamingMode(0);

            OutputStream out = new BufferedOutputStream(urlConnection.getOutputStream());
            BufferedWriter writer = new BufferedWriter(new OutputStreamWriter(
                    out, "UTF-8"));
            writer.write(postData.toString());
            writer.flush();

            int code = urlConnection.getResponseCode();
            if (code !=  201) {
                throw new IOException("Invalid response from server: " + code);
            }

            BufferedReader rd = new BufferedReader(new InputStreamReader(
                    urlConnection.getInputStream()));
            String line;
            while ((line = rd.readLine()) != null) {
                Log.i("data", line);
            }
        } catch (Exception e) {
            e.printStackTrace();
        } finally {
            if (urlConnection != null) {
                urlConnection.disconnect();
            }
        }


        return "Ca s'est bien passé";
    }

    public String getUrl() {
        return url;
    }

    public void setUrl(String url) {
        this.url = url;
    }

    public String getIdVanne() {
        return idVanne;
    }

    public void setIdVanne(String idVanne) {
        this.idVanne = idVanne;
    }

    public JSONObject getJsonFile() {
        return jsonObj;
    }

    public void setJsonFile(JSONObject jsonObj) {
        this.jsonObj = jsonObj;
    }
}
