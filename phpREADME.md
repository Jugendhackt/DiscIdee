Über Get wird mindestens die Variable action übergeben. alle darauffolgenden Variablen werden von par1, par2, ... durchnummeriert

Beispiel:
http://localhost/handler.php?action=addArgument&par1=HierKoennteEinWichtiges ArgumentStehen&par2=1&par3=0

Fuegt ein Argument mit dem Text "HierKoennteEinWichtiges ArgumentStehen" zum Thema mit der ID 1 welches ein contra Argument ist(isPro==0).

Übersicht: 

| Action | par1 | par2 | par3  | Beschreibung  |
|:------:|:---:|:----:|:-:|:-:|
|    tatsaechlcher Wert als String    |  muss ersetzt werden   |    muss ersetzt werden  |  muss ersetzt werden |   |
|topic |     |      |   | liste Aller Topics  |
|  getForTopic      |   topicID  |      |   | gibt alle Attribute für ein topic   |
|    addTopic    |  topic Name   |   topic question   |   |   |
|    addArgument    |  text   |  topicID    | boolean das aussagt ob pro Argument   |   |
|   addReason     |   text  |    argumentID  |   |   |
|    addExample    | text    |   reasonID   |   |   |
|        |     |      |   |   |
|    removeTopic    |    topicID |      |   |   |
|    removeArgument    |  argumentID   |      |   |   |
|      removeReason  | reasonID    |      |   |   |
|     removeExample   |  exampleID   |      |   |   |
|        |     |      |   |   |
|        |     |      |   |   |
|        |     |      |   |   |