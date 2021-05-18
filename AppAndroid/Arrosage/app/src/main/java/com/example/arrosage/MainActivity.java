package com.example.arrosage;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageView;

public class MainActivity extends AppCompatActivity {

    private ImageView meteo;
    private ImageView circuits;
    private ImageView param;
    private ImageView conso;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        this.meteo = (ImageView) findViewById(R.id.meteo);
        this.circuits = (ImageView) findViewById(R.id.circuits);
        this.param = (ImageView) findViewById(R.id.param);
        this.conso = (ImageView) findViewById(R.id.conso);

        meteo.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent otherActivity = new Intent(getApplicationContext(), MeteoActivity.class);
                startActivity(otherActivity);
                finish();
            }
        });

        circuits.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent otherActivity = new Intent(getApplicationContext(), CircuitsActivity.class);
                startActivity(otherActivity);
                finish();
            }
        });

        param.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent otherActivity = new Intent(getApplicationContext(), VannesActivity.class);
                startActivity(otherActivity);
                finish();
            }
        });

        conso.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent otherActivity = new Intent(getApplicationContext(), ConsoActivity.class);
                startActivity(otherActivity);
                finish();
            }
        });
    }
}