# Nexthink Interview Project WordPress Server

WordPress site bootstrapped using Local WP.

Plugins used:

- Advanced Custom Fields

Production site hosted on FlyWheel.

Endpoints:

**wp-json/api/get_characters**

Returns an array of JSON objects with information for each character.

```JSON
[
    {
        "character_description": "Dark. Mysterious. Deadly. You also sparkle. Very cool.",
        "character_image": {},
        "character_name": "Edward Cullen",
        "character_quote": "What if I'm not a hero. What if I'm the bad guy?",
        "character_source": "Twilight",
        "character_weight": "Cool"
    },
]
```

**wp-json/api/get_questions**

Returns an array of JSON objects with the text, image, answers, and weights for each question.

```JSON
[
    {
        "question_text": "Where would you hunt?",
        "image": {},
        "a": "Puppet shows",
        "a_weight": "Count",
        "b": "Dark forests",
        "b_weight": "Evil",
        "c": "Your high school",
        "c_weight": "Cool",
        "d": "Clubs and parties",
        "d_weight": "Goofy"
    },
```
