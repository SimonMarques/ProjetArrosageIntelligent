package com.example.arrosage;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;

public class VannesActivity extends AppCompatActivity {

    private ImageView cardVanne1, cardVanne2;
    private Button btnRetour;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_vannes);
        getSupportActionBar().setTitle("Vannes de votre circuit");

        this.cardVanne1 = (ImageView) findViewById(R.id.cardVanne1);
        this.cardVanne2 = (ImageView) findViewById(R.id.cardVanne2);
        this.btnRetour = (Button) findViewById(R.id.buttonRetourVanne);


        cardVanne1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent mainActivity = new Intent(getApplicationContext(), ParamActivity.class);
                startActivity(mainActivity);
                finish();
            }
        });
        cardVanne2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent mainActivity = new Intent(getApplicationContext(), ParamActivity2.class);
                startActivity(mainActivity);
                finish();
            }
        });
        btnRetour.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent mainActivity = new Intent(getApplicationContext(), MainActivity.class);
                startActivity(mainActivity);
                finish();
            }
        });
    }
}