package com.example.arrosage;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class ConsoActivity extends AppCompatActivity {

    private Button btnConso;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_conso);
        getSupportActionBar().setTitle("Consommation d'eau");

        this.btnConso = (Button) findViewById(R.id.buttonRetourConso);

        btnConso.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent mainActivity = new Intent(getApplicationContext(), MainActivity.class);
                startActivity(mainActivity);
                finish();
            }
        });

    }
}