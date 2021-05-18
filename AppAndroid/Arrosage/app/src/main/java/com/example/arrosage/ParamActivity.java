package com.example.arrosage;

import androidx.appcompat.app.AppCompatActivity;

import android.app.DatePickerDialog;
import android.app.TimePickerDialog;
import android.content.Context;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.os.ParcelFileDescriptor;
import android.text.InputType;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TimePicker;

import com.google.gson.JsonObject;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.concurrent.ExecutionException;

import okhttp3.Call;
import okhttp3.Callback;
import okhttp3.MediaType;
import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.RequestBody;
import okhttp3.Response;
import okhttp3.ResponseBody;

public class ParamActivity extends AppCompatActivity {

    private Button btnRetour, btnValidate;
    private ImageView cardVanne;
    private EditText editSetDate, editSetTimeStart, editSetTimeEnd;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_param);
        getSupportActionBar().setTitle("Programmation");

        this.btnRetour = (Button) findViewById(R.id.buttonRetourParam);
        this.btnValidate = (Button) findViewById(R.id.buttonValidate);
        this.cardVanne = (ImageView) findViewById(R.id.cardVanne);
        this.editSetDate = findViewById(R.id.editSetDate);
        this.editSetTimeStart = findViewById(R.id.editSetTimeStart);
        this.editSetTimeEnd = findViewById(R.id.editSetTimeEnd);


        editSetDate.setInputType(InputType.TYPE_NULL);
        editSetTimeStart.setInputType(InputType.TYPE_NULL);
        editSetTimeEnd.setInputType(InputType.TYPE_NULL);

        btnRetour.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent mainActivity = new Intent(getApplicationContext(), VannesActivity.class);
                startActivity(mainActivity);
                finish();
            }
        });

        btnValidate.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Vanne vanne = new Vanne();
                vanne.setId("2");
                vanne.setDate(editSetDate.getText().toString());
                vanne.setHeureDebut(editSetTimeStart.getText().toString());
                vanne.setHeureFin(editSetTimeEnd.getText().toString());
                Intent intent = new Intent(getApplicationContext(), CircuitsActivity.class);
                intent.putExtra("editSetDate", vanne.getDate());
                intent.putExtra("editSetTimeStart",vanne.getHeureDebut());
                intent.putExtra("editSetTimeEnd",vanne.getHeureFin());
                startActivity(intent);

                JSONObject obj = new JSONObject();

                try {
                    obj.put("idVanne", vanne.getId());
                    obj.put("date", vanne.getDate());
                    obj.put("heureDebut", vanne.getHeureDebut());
                    obj.put("heureFin", vanne.getHeureFin());
                } catch (JSONException e) {
                    e.printStackTrace();
                }

                /*IoTSendProgrammation send = new IoTSendProgrammation();
                send.execute();

                Object resultTask = null;
                try {
                    resultTask= send.get();
                } catch (ExecutionException e) {
                    e.printStackTrace();
                } catch (InterruptedException e) {
                    e.printStackTrace();
                }

                String res = resultTask.toString();*/

                OkHttpClient client = new OkHttpClient();

                Request get = new Request.Builder()
                        .url("https://reqres.in/api/users?page=2")
                        .build();

                client.newCall(get).enqueue(new Callback() {
                    @Override
                    public void onFailure(Call call, IOException e) {
                        e.printStackTrace();
                    }

                    @Override
                    public void onResponse(Call call, Response response) {
                        try {
                            ResponseBody responseBody = response.body();
                            if (!response.isSuccessful()) {
                                throw new IOException("Unexpected code " + response);
                            }

                            Log.i("data", responseBody.string());
                        } catch (Exception e) {
                            e.printStackTrace();
                        }
                    }
                });

                // POST
                JsonObject postData = new JsonObject();
                postData.addProperty("name", "morpheus");
                postData.addProperty("job", "leader");

                final MediaType JSON = MediaType.parse("application/json; charset=utf-8");
                RequestBody postBody = RequestBody.create(JSON, postData.toString());
                Request post = new Request.Builder()
                        .url("https://reqres.in/api/users")
                        .post(postBody)
                        .build();

                client.newCall(post).enqueue(new Callback() {
                    @Override
                    public void onFailure(Call call, IOException e) {
                        e.printStackTrace();
                    }

                    @Override
                    public void onResponse(Call call, Response response) {
                        try {
                            ResponseBody responseBody = response.body();
                            if (!response.isSuccessful()) {
                                throw new IOException("Unexpected code " + response);
                            }

                            Log.i("data", responseBody.string());
                        } catch (Exception e) {
                            e.printStackTrace();
                        }
                    }
                });




                /*String pwd = System.getProperty("user.dir");
                String s = String.valueOf(obj);
                //Write JSON file
                File path = getApplicationContext().getFilesDir();

                File file = new File(path, "fichier.json");

                FileOutputStream stream = null;
                try {
                    stream = new FileOutputStream(file);
                } catch (FileNotFoundException e) {
                    e.printStackTrace();
                }
                try {
                    try {
                        stream.write(String.valueOf(obj).getBytes());
                    } catch (IOException e) {
                        e.printStackTrace();
                    }
                } finally {
                    try {
                        stream.close();
                    } catch (IOException e) {
                        e.printStackTrace();
                    }
                }*/
            }
        });

        editSetDate.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                showDateDialog(editSetDate);
            }
        });

        editSetTimeStart.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                showTimeDialog(editSetTimeStart);
            }
        });
        editSetTimeEnd.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                showTimeDialog(editSetTimeEnd);
            }
        });

    }


    private void showTimeDialog(EditText setTime) {
        Calendar calendar = Calendar.getInstance();

        TimePickerDialog.OnTimeSetListener timeSetListener = new TimePickerDialog.OnTimeSetListener() {
            @Override
            public void onTimeSet(TimePicker view, int hourOfDay, int minute) {
                calendar.set(Calendar.HOUR_OF_DAY, hourOfDay);
                calendar.set(Calendar.MINUTE, minute);
                String timeStr = String.valueOf(hourOfDay)+":"+String.valueOf(minute);
                SimpleDateFormat simpleDateFormat = new SimpleDateFormat("HH:mm");
                Date date = null;
                try {
                    date = simpleDateFormat.parse(timeStr);
                } catch (ParseException e) {
                    e.printStackTrace();
                }
                timeStr = simpleDateFormat.format(date);
                setTime.setText(timeStr);
            }
        };

        new TimePickerDialog(ParamActivity.this, timeSetListener, calendar.get(Calendar.HOUR_OF_DAY), calendar.get(Calendar.MINUTE), true).show();

    }

    private void showDateDialog(EditText setDate){
        Calendar calendar  = Calendar.getInstance();
        DatePickerDialog.OnDateSetListener dateSetListener = new DatePickerDialog.OnDateSetListener(){
            @Override
            public void onDateSet(DatePicker view, int year, int month, int dayOfMonth) {
                calendar.set(Calendar.YEAR,year);
                calendar.set(Calendar.MONTH, month);
                calendar.set(Calendar.DAY_OF_MONTH, dayOfMonth);

                String dateStr = String.valueOf(year)+"-"+String.valueOf(month)+"-"+String.valueOf(dayOfMonth);
                SimpleDateFormat simpleDateFormat = new SimpleDateFormat("yyyy-MM-dd");
                Date date = null;
                try {
                    date = simpleDateFormat.parse(dateStr);
                } catch (ParseException e) {
                    e.printStackTrace();
                }
                dateStr = simpleDateFormat.format(date);
                setDate.setText(dateStr);
            }
        };
        new DatePickerDialog(ParamActivity.this, dateSetListener, calendar.get(Calendar.YEAR),calendar.get(Calendar.MONTH), calendar.get(Calendar.DAY_OF_MONTH)).show();
    }


}