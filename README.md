# projetM1

Réunion 13 mars https://gist.github.com/serut/3e586dc2918b75f3a4c0

 s'agit de construire un outil d'aide à la planification des services enseignants. Les formations sont composées d'UE qui sont elles mêmes composées d'éléments pédagogiques. A chaque élément on attribue des groupes d'étudiants, un volume d'heures de CM, de TD et de TP. Un enseignant peut intervenir sur plusieurs éléments pédagogiques, sur plusieurs formations. Les heures d'enseignements d'un élément pédagogique sont réalisées par un ou plusieurs enseignants.
L'outil à réaliser doit permettre d'affecter les heures d'enseignements aux enseignants concernés et de planifier ces enseignements sur différentes périodes (c'est surtout sur ce point qu'il y a un travail de réflexion à fournir au niveau IHM).
Cet outil correspond à une phase macroscopique de planification avant l'élaboration de l'emploi du temps (pour lequel nous avons déjà un outil).
Par exemple, l'outil à réaliser doit permettre de positionner 7 séances concernant 6 groupes de TD entre la rentrée de Septembre et les vacances de Toussaint. L'enseignant X encadrera 3 groupes de TD, et l'enseignant Y les 3 autres groupes.
Mais le fait de créer une séance le lundi 1er Septembre de 8h à 9h30 avec le groupe 3 encadré par l'enseignant Y est géré par l'outil d'emploi du temps.
L'outil à réaliser devra également fournir un récapitulatif du service de chaque enseignant et vérifier que ce dernier remplit ses obligations statutaires.
Technologiquement, il s'agit de faire évoluer une base de données MySQL et de créer une interface web.
