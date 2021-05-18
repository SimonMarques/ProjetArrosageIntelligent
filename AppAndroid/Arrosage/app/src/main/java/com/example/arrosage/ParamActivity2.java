package com.example.arrosage;

import androidx.appcompat.app.AppCompatActivity;

import android.app.DatePickerDialog;
import android.app.TimePickerDialog;
import android.content.Intent;
import android.os.Bundle;
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

import java.io.IOException;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;

import okhttp3.Call;
import okhttp3.Callback;
import okhttp3.MediaType;
import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.RequestBody;
import okhttp3.Response;
import okhttp3.ResponseBody;

public class ParamActivity2 extends AppCompatActivity {

    private Button btnRetour2, btnValidate2;
    private ImageView cardVanne2;
    private EditText editSetDate2, editSetTimeStart2, editSetTimeEnd2;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_param2);

        getSupportActionBar().setTitle("Programmation");

        this.btnRetour2 = (Button) findViewById(R.id.buttonRetourParam2);
        this.btnValidate2 = (Button) findViewById(R.id.buttonValidate2);
        this.cardVanne2 = (ImageView) findViewById(R.id.cardVanne2);
        this.editSetDate2 = findViewById(R.id.editSetDate2);
        this.editSetTimeStart2 = findViewById(R.id.editSetTimeStart2);
        this.editSetTimeEnd2 = findViewById(R.id.editSetTimeEnd2);


        editSetDate2.setInputType(InputType.TYPE_NULL);
        editSetTimeStart2.setInputType(InputType.TYPE_NULL);
        editSetTimeEnd2.setInputType(InputType.TYPE_NULL);


        btnRetour2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent mainActivity = new Intent(getApplicationContext(), VannesActivity.class);
                startActivity(mainActivity);
                finish();
            }
        });

        btnValidate2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Vanne vanne = new Vanne();
                vanne.setId("2");
                vanne.setDate(editSetDate2.getText().toString());
                vanne.setHeureDebut(editSetTimeStart2.getText().toString());
                vanne.setHeureFin(editSetTimeEnd2.getText().toString());
                Intent intent = new Intent(getApplicationContext(), CircuitsActivity.class);
                intent.putExtra("editSetDate2", vanne.getDate());
                intent.putExtra("editSetTimeStart2",vanne.getHeureDebut());
                intent.putExtra("editSetTimeEnd2",vanne.getHeureFin());
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

                /*OkHttpClient client = new OkHttpClient();

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
                });*/




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

        editSetDate2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                showDateDialog(editSetDate2);
            }
        });

        editSetTimeStart2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                showTimeDialog(editSetTimeStart2);
            }
        });
        editSetTimeEnd2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                showTimeDialog(editSetTimeEnd2);
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

        new TimePickerDialog(ParamActivity2.this, timeSetListener, calendar.get(Calendar.HOUR_OF_DAY), calendar.get(Calendar.MINUTE), true).show();

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
        new DatePickerDialog(ParamActivity2.this, dateSetListener, calendar.get(Calendar.YEAR),calendar.get(Calendar.MONTH), calendar.get(Calendar.DAY_OF_MONTH)).show();

    }
}