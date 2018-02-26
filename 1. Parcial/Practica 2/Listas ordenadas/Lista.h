#ifndef LISTAENLAZADA_H
#define LISTAENLAZADA_H
#include <iostream>
#include <string>
#include <cctype>
#include <cstdio>

using namespace std;

#define ASCENDENTE 1
#define DESCENDENTE 0

template<class T> class Lista;

template<class T>
class Nodo {
	private:
		T valor;
		Nodo<T> *siguiente;
		Nodo<T> *anterior;
	public:
		Nodo(T v, Nodo<T> *sig = NULL, Nodo<T> *ant = NULL) :
		valor(v), siguiente(sig), anterior(ant) {}
	friend class Lista<T>;
};

template<class T>
class Lista {
	private:
		Nodo<T> *plista;
	public:
		Lista() : plista(NULL) {}
		~Lista();
		void Anadir(T v);
		void AnadirSinOrden(T v);
		void AnadirString(T v);
		void Eliminar(T &v);
		bool isVacia() { return plista == NULL; }
		void Imprimir(int);
		void ImprimirClase(int);
		void Siguiente();
		void Anterior();
		void Primero();
		void Ultimo();
		bool Actual() { return plista != NULL; }
		T ValorActual() { return plista->valor; }
};

template<class T>
Lista<T>::~Lista()
{
	Nodo<T> *aux;
	Primero();
	while(plista) {
		aux = plista;
		plista = plista->siguiente;
		delete aux;
	}               
}

template<class T>
void Lista<T>::Anadir(T v)
{
	Nodo<T> *nuevo;
		
	Primero();
	if(isVacia() || plista->valor > v) {
		nuevo = new Nodo<T>(v, plista);
		if(!plista)
			plista = nuevo;
		else 
			plista->anterior = nuevo;
	} else {
		while(plista->siguiente && plista->siguiente->valor <= v)
			Siguiente();
		nuevo = new Nodo<T>(v, plista->siguiente, plista);
		plista->siguiente = nuevo;
		if(nuevo->siguiente) 
			nuevo->siguiente->anterior = nuevo;
	}
}

template<class T>
void Lista<T>::AnadirString(T v)
{
	Nodo<T> *nuevo;
		
	char *extra = strdup(v.c_str());
	
	for (int i = 0; extra[i]; i++)
		extra[i] = tolower(extra[i]);	
	
	Primero();
	if(isVacia() || plista->valor > extra) {
		nuevo = new Nodo<T>(extra, plista);
		if(!plista)
			plista = nuevo;
		else 
			plista->anterior = nuevo;
	} else {
		while(plista->siguiente && plista->siguiente->valor <= v)
			Siguiente();
		nuevo = new Nodo<T>(extra, plista->siguiente, plista);
		plista->siguiente = nuevo;
		if(nuevo->siguiente) 
			nuevo->siguiente->anterior = nuevo;
	}
}

template<class T>
void Lista<T>::AnadirSinOrden(T v)
{
	Nodo<T> *nuevo;
	
	Primero();
	if(isVacia()) {
		nuevo = new Nodo<T>(v, plista);
		if(!plista)
			plista = nuevo;
		else 
			plista->anterior = nuevo;
	} else {
		while(plista->siguiente)
			Siguiente();
		nuevo = new Nodo<T>(v, plista->siguiente, plista);
		plista->siguiente = nuevo;
		if(nuevo->siguiente) 
			nuevo->siguiente->anterior = nuevo;
	}
}
template<class T>
void Lista<T>::Eliminar(T &v)
{
	Nodo<T> *pNodo,*aux;
	Primero();
	pNodo = plista;
	while(!(pNodo->valor==v) && pNodo){
		Siguiente();
		pNodo=plista;
	}
	Primero();
	if(pNodo==plista){
		if (pNodo->siguiente==NULL){
			plista=NULL;
		} else {
			aux=plista;
			plista=pNodo->siguiente;
			plista->anterior=NULL;
			delete aux;
		}
	}else{
		Ultimo();
		if (pNodo==plista){
			pNodo->anterior->siguiente=NULL;
			aux=pNodo;
			delete aux;
		} else {
			pNodo->anterior->siguiente=pNodo->siguiente;
			pNodo->siguiente->anterior=pNodo->anterior;
			aux=pNodo;
			delete aux;
		}
	}
	
}

template<class T>
void Lista<T>::Imprimir(int orden)
{
	Nodo<T> *pNodo;
	if(orden == ASCENDENTE) {
		Primero();
		pNodo = plista;
		if(!pNodo)cout<<"lista doble vacia"<<endl;
		while(pNodo) {
			cout << pNodo->valor << " ";
			pNodo = pNodo->siguiente;
		}
	} else {
		Ultimo();
		pNodo = plista;
		if(!pNodo)cout<<"lista doble vacia"<<endl;
		while(pNodo) {
			cout << pNodo->valor << " ";
			pNodo = pNodo->anterior;
		}
	}
	cout<<endl;
}

template<class T>
void Lista<T>::ImprimirClase(int orden)
{
	Nodo<T> *pNodo;
	if(orden == ASCENDENTE) {
		Primero();
		pNodo = plista;
		while(pNodo) {
			pNodo->valor.imprimir();
			pNodo = pNodo->siguiente;
		}
	} else {
		Ultimo();
		pNodo = plista;
		while(pNodo) {
			pNodo->valor.imprimir();
			pNodo = pNodo->anterior;
		}
	}
	cout<<endl;
}

template<class T>
void Lista<T>::Siguiente()
{
	if(plista) 
		plista = plista->siguiente;
}

template<class T>
void Lista<T>::Anterior()
{
	if(plista) 
		plista = plista->anterior;
}

template<class T>
void Lista<T>::Primero()
{
	while(plista && plista->anterior) 
		plista = plista->anterior;
}

template<class T>
void Lista<T>::Ultimo()
{
	while(plista && plista->siguiente) 
		plista = plista->siguiente;
}
#endif

