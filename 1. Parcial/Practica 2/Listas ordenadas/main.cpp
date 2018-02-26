#include <iostream>
#include <string>
#include <cstring>
#include <fstream>
#include <vector>
#include <cstdlib>
#include "Lista.h"

using namespace std;

void load(string path);

int main(int argc, char** argv) {

	load("list.txt");

	return 0;
}

void load(string path) {
	fstream file;
	file.open(path.c_str(), ios::in);

	string line;
	char *split;
	vector<string> type;
	Lista<string> list_string;
	Lista<int> list_int;

	if (file.fail())
		cout << "Error" << endl;
	else {
		while (getline(file, line)) {	
			split = strtok(&line[0], ",. ");
			
			while (split) {
				if (isalpha(split[0])) {
					type.push_back("chr");
					list_string.AnadirString(split);
				} else {
					type.push_back("int");
					list_int.Anadir(atoi(split));
				}
				split = strtok(NULL,",. ");
			}
			
			for (int i = 0; i < type.size(); i++) {
				if (type[i] == "chr") {
					list_string.Primero();
					string actual = list_string.ValorActual();
					cout << actual << " ";
					list_string.Eliminar(actual);		
				} else {
					list_int.Primero();
					int actual = list_int.ValorActual();
					cout << actual << " ";
					list_int.Eliminar(actual);
				}
			}
			cout << endl;
			type.clear();
		}

	}
}
