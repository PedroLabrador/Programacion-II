#include <iostream>
#include <fstream>
#include <string>
#include <ctype.h>
#include <cstring>
#include "Grafo.h"

using namespace std;

void load(string path);

int main(int argc, char** argv) {

	load("map.txt");
	
	return 0;
}

void load(string path) {
	
	fstream file(path.c_str(), ios::in);
	
	string line;
	char *split;
	
	int number_of_paths;
	int start, end;

	while (getline(file, line)) {
		Grafo grafo(true, true);
		
		split = strtok(&line[0], " ");
		split = strtok(NULL, " ");
		number_of_paths = atoi(split);
		
		getline(file, line);
		split = strtok(&line[0], " ");		
		start = atoi(split);
		split = strtok(NULL, " ");
		end = atoi(split);
		
		if (start == 0 && end == 0)
			break;
		
		char st[5];
		char nd[5];
		itoa(start, st, 10);
		itoa(end,   nd, 10);
				
		for (int i = 0; i < number_of_paths; i++) {
			getline(file, line);
			split = strtok(&line[0], " ");
			string v1 = string(split);
			split = strtok(NULL, " ");
			string v2 = string(split);
			split = strtok(NULL, " ");
			int weight = atoi(split);
			
			
			Vertice *a = new Vertice(v1, weight);
			Vertice *b = new Vertice(v2, weight);
			
			grafo.agregar(a, b);		
		}	
		
		//grafo.BuscarCaminosVertices(new Vertice(string(st)), new Vertice(string(nd)));
		grafo.buscarCaminos_MinMaxLongitud_Vertices(new Vertice(string(st)), new Vertice(string(nd)), true);
		
		int value = grafo.imprimirListaCaminos();
		
		if (value == 0)
			cout << "-1" << endl;
		else
			cout << value << endl;
		
	}
	
}
