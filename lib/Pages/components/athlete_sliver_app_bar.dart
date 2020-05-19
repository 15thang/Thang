import 'package:flutter/material.dart';

class AthleteSliverAppBar extends StatelessWidget {
  final String _title;

  const AthleteSliverAppBar(
    this._title, {
    Key key,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return SliverAppBar(
      iconTheme: IconThemeData(
        color: Colors.white,
      ),
      backgroundColor: Colors.black,
      title: Text(
        'Athletes ('+ _title + ')',
        style: TextStyle(color: Colors.white),
      ),
    );
  }
}