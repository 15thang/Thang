import 'dart:convert';
import 'dart:ui';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:wfl_app/Pages/AthletesDetailPage.dart';
import '../model/athletes.dart';

class AthletesPage extends StatefulWidget {
  @override
  _AthletesPageState createState() => _AthletesPageState();
}

class _AthletesPageState extends State<AthletesPage> {
  static String routeName;

  List<Athlete> _notes = List<Athlete>();

  Future<List<Athlete>> fetchNotes() async {
    var url = 'http://superfighter.nl/APP_output_athlete.php';
    var response = await http.get(url);

    var notes = List<Athlete>();

    if (response.statusCode == 200) {
      var notesJson = json.decode(response.body);
      for (var noteJson in notesJson) {
        notes.add(Athlete.fromJson(noteJson));
      }
    }
    return notes;
  }

  @override
  void initState() {
    fetchNotes().then((value) {
      setState(() {
        _notes.addAll(value);
      });
    });
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: ListView.builder(
        itemBuilder: (context, index) {
          String athleteWeightclass = _notes[index].athleteWeightclass;
          switch (athleteWeightclass) {
            case '0':
              athleteWeightclass = '';
              break;
            case '1':
              athleteWeightclass = 'Heavyweight';
              break;
            case '2':
              athleteWeightclass = 'Light Heavyweight';
              break;
            case '3':
              athleteWeightclass = 'Middleweight';
              break;
            case '4':
              athleteWeightclass = 'Welterweight';
              break;
            case '5':
              athleteWeightclass = 'Lightweight';
              break;
            case '6':
              athleteWeightclass = 'Featherweight';
              break;
            case '7':
              athleteWeightclass = 'Bantamweight';
              break;
            case '8':
              athleteWeightclass = 'Flyweight';
              break;
            case '9':
              athleteWeightclass = 'Strawweight';
              break;
          }
          return new GestureDetector(
            onTap: () {
              Navigator.push(
                context,
                MaterialPageRoute(
                  builder: (context) =>
                      AthletesDetailPage(athlete: _notes[index]),
                ),
              );
            },
            child: new Card(
              color: Colors.blueGrey[50],
              elevation: 5,
              child: Row(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: <Widget>[
                  Container(
                    height: 174,
                    width: 400,
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.only(
                          bottomLeft: Radius.circular(5),
                          topLeft: Radius.circular(5)),
                    ),
                    child: Row(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: <Widget>[
                        Container(
                            width: 174,
                            height: 174,
                            decoration: BoxDecoration(
                                borderRadius: BorderRadius.only(
                                    bottomLeft: Radius.circular(5),
                                    topLeft: Radius.circular(5)),
                                image: new DecorationImage(
                                    image: new NetworkImage(
                                        _notes[index].athletePicture),
                                    fit: BoxFit.cover))),
                        Container(
                            padding: const EdgeInsets.all(10),
                            height: 174,
                            child: Column(
                              crossAxisAlignment: CrossAxisAlignment.start,
                              children: <Widget>[
                                Text(_notes[index].athleteFullName,
                                    style:
                                        TextStyle(fontWeight: FontWeight.bold)),
                                Text(_notes[index].athleteNickname),
                                Text(_notes[index].athleteNationality),
                                Text(_notes[index].athleteDayOfBirth),
                                Text(athleteWeightclass),
                                SizedBox(
                                  height: 10,
                                ),
                                Container(
                                  margin: const EdgeInsets.only(top: 35.0),
                                  width: 170,
                                  child: Text("Lees meer >",
                                      style: TextStyle(
                                          fontWeight: FontWeight.bold)),
                                ),
                              ],
                            )),
                      ],
                    ),
                  ),
                ],
              ),
            ),
          );
        },
        itemCount: _notes.length,
      ),
    );
  }
  /*@override
  Widget build(BuildContext context) {
    final List<Widget> widgets = List(athleteList.length);
    for (var i = 0; i < athleteList.length; i++) {
      widgets[i] = GestureDetector(
          onTap: () {
            Navigator.push(
              context,
              MaterialPageRoute(
                builder: (context) => AthletesDetailPage(athlete: athleteList[i]),  
              ),
            );
            print("Container clicked " + i.toString());
          },
          child: Container(
            child: Column(
              children: <Widget>[
                Card(
                  color: Colors.blueGrey[50],
                  elevation: 5,
                  child: Row(
                    children: <Widget>[
                      Container(
                        height: 200,
                        width: 174,
                        decoration: BoxDecoration(
                          borderRadius: BorderRadius.only(
                              bottomLeft: Radius.circular(5),
                              topLeft: Radius.circular(5)),
                          image: DecorationImage(
                            fit: BoxFit.cover,
                            image: NetworkImage(athleteList[i].imageUrl),
                          ),
                        ),
                      ),
                      Container(
                          padding: const EdgeInsets.all(10),
                          height: 150,
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: <Widget>[
                              Text(
                                athleteList[i].title,
                                style: TextStyle(
                                  fontSize: 16,
                                  fontWeight: FontWeight.bold,
                                ),
                              ),
                              SizedBox(
                                height: 10,
                              ),
                              Container(
                                  width: 170,
                                  child: Text(athleteList[i].description)),
                            ],
                          )
                          )
                    ],
                  ),
                ),
                SizedBox(
                  height: 10,
                ),
              ],
            ),
          ));
    }

    return Container(
        height: double.infinity,
        padding: const EdgeInsets.symmetric(horizontal: 10),
        child: ListView(
          children: widgets.toList(),
        ));
  }*/
}
