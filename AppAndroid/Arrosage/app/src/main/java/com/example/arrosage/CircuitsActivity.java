package com.example.arrosage;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.Switch;
import android.widget.TextView;

import org.apache.http.client.methods.HttpPost;
import org.json.JSONException;
import org.json.JSONObject;
import org.apache.http.*;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;

import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.util.concurrent.ExecutionException;

public class CircuitsActivity extends AppCompatActivity {

    private Button btnRetour;
    private Switch simpleSwitch, simpleSwitch2;
    private TextView dateVanne1, heureDebutVanne1, heureFinVanne1, dateVanne2, heureDebutVanne2,heureFinVanne2;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        Vanne vanne = new Vanne();
        Vanne vanne2 = new Vanne();
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_circuits);
        getSupportActionBar().setTitle("Circuit d'arrosage");
        this.btnRetour = (Button) findViewById(R.id.buttonRetourCircuit);
        this.simpleSwitch = (Switch) findViewById(R.id.switchOnOff);
        this.simpleSwitch2 = (Switch) findViewById(R.id.switchOnOff2);

        this.dateVanne1 = (TextView) findViewById(R.id.textViewRoutineVal);
        this.heureDebutVanne1 = (TextView) findViewById(R.id.textViewDebutVal);
        this.heureFinVanne1 = (TextView) findViewById(R.id.textViewFinVal);

        this.dateVanne2 = (TextView) findViewById(R.id.textViewRoutineVal2);
        this.heureDebutVanne2 = (TextView) findViewById(R.id.textViewDebutVal2);
        this.heureFinVanne2 = (TextView) findViewById(R.id.textViewFinVal2);

        Boolean isProgrammed = false;
        Boolean isProgrammed2 = false;
        Intent intent = getIntent();
        if (intent != null){
            String str = "";
            if (intent.hasExtra("editSetDate")){
                vanne.setDate(intent.getStringExtra("editSetDate"));
            }if(intent.hasExtra("editSetTimeStart")){
                vanne.setHeureDebut(intent.getStringExtra("editSetTimeStart"));
            }if(intent.hasExtra("editSetTimeEnd")){
                vanne.setHeureFin(intent.getStringExtra("editSetTimeEnd"));
            }

            dateVanne1.setText(vanne.getDate());
            heureDebutVanne1.setText(vanne.getHeureDebut());
            heureFinVanne1.setText(vanne.getHeureFin());
            isProgrammed = true;
        }

        if (intent != null){
            String str = "";
            if (intent.hasExtra("editSetDate2")){
                vanne.setDate(intent.getStringExtra("editSetDate2"));
            }if(intent.hasExtra("editSetTimeStart2")){
                vanne.setHeureDebut(intent.getStringExtra("editSetTimeStart2"));
            }if(intent.hasExtra("editSetTimeEnd2")){
                vanne.setHeureFin(intent.getStringExtra("editSetTimeEnd2"));
            }

            dateVanne2.setText(vanne.getDate());
            heureDebutVanne2.setText(vanne.getHeureDebut());
            heureFinVanne2.setText(vanne.getHeureFin());
            isProgrammed2 = true;
        }

        setOnOffSwitch(simpleSwitch, "http://projet18.ddns.net:44480/Json/Json_Statut/Vanne.json");
        setOnOffSwitch(simpleSwitch2, "http://projet18.ddns.net:44480/Json/Json_Statut/Vanne2.json");

        if(!isProgrammed){
            setDateAndTime(dateVanne1,heureDebutVanne1,  heureFinVanne1, "1", vanne);
        }
        if(!isProgrammed2){
            setDateAndTime(dateVanne2,heureDebutVanne2,  heureFinVanne2, "2", vanne2);
        }


        btnRetour.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent mainActivity = new Intent(getApplicationContext(), MainActivity.class);
                startActivity(mainActivity);
                finish();
            }
        });
    }
    private void setOnOffSwitch( Switch sw, String url){

        IotConnectionFormat myTask = new IotConnectionFormat(url);
        myTask.execute();

        Object resultTask = null;
        try {
            resultTask= myTask.get();
        } catch (ExecutionException e) {
            e.printStackTrace();
        } catch (InterruptedException e) {
            e.printStackTrace();
        }

        String res = resultTask.toString();
        Boolean onOff = false;

        try {
            // get JSONObject from JSON file
            JSONObject obj = new JSONObject(res);
            if( obj.getString("statut").equals("1")) {
                onOff = true;
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
        //set the current state of a Switch
        sw.setChecked(onOff);
    }

    private void setDateAndTime ( TextView dateVanne, TextView heureDebutVanne, TextView heureFinVanne, String idVanne, Vanne vanne){
        IotConnectionDate myTaskDate = new IotConnectionDate(idVanne);
        myTaskDate.execute();

        Object resultTaskDate = null;
        try {
            resultTaskDate= myTaskDate.get();
        } catch (ExecutionException e) {
            e.printStackTrace();
        } catch (InterruptedException e) {
            e.printStackTrace();
        }

        String resDate = resultTaskDate.toString();

        try {
            // get JSONObject from JSON file
            JSONObject objDate = new JSONObject(resDate);

            vanne.setId(objDate.getString("idVanne"));
            vanne.setDate(objDate.getString("date"));
            vanne.setHeureDebut(objDate.getString("heureDebut"));
            vanne.setHeureFin(objDate.getString("heureFin"));

        } catch (JSONException e) {
            e.printStackTrace();
        }

        dateVanne.setText(vanne.getDate());
        heureDebutVanne.setText(vanne.getHeureDebut());
        heureFinVanne.setText(vanne.getHeureFin());

    }
}