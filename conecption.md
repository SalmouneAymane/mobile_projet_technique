

## Data dictionary:
	song
	artist
	coverImage
	status
	dateOfCreation
	dateOfPublication
	genre
	artistProfilePicture
	ArtistDateOfCreation

## Decomposition  :
#### song:
	id,
	song,
	coverImage,
	status,
	dateOfCreation,
	dateOfPublication
#### Artist:
	id,
	ArtistName,
	ArtistDateOfCreation,
	artistProfilePicture
#### genre:
	id,
	genreName

## Cardinality :

Artists --create -- songs 
songs -- belonge -- genre 

artists can create multiple songs 
a song is created by 1 artist 
a song can belonge to 1 genre 
a genre can be in multiple songs 

Artists -(0,N)-create -(1,1)- songs 
songs -(1,1)- belonge -(0,N)- genre 

## MCD :
![[Pasted image 20260915110313.png]](MCD.png)