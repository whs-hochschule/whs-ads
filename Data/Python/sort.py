# -*- coding: utf-8 -*-

'''
Dies loest die ersten Aufgaben von Blatt 2 in ADS.
Einfach mit:

  python sorting.py

aufrufen (python 3)

oder bei repl.it ausprobieren mit Cut-and-Paste:

https://repl.it/languages/python3
'''

DEBUG = False # in False ändern, wenn Sie nur die Päckchen
     # plus ein wenig Erläuterungstext sehen wollen

def insertionSort(a):
    count = 0 # Count comparisons
    for i in range(1,len(a)):
        element = a[i]
        j = i-1
        while j >= 0 and element < a[j]:
            a[j + 1] = a[j]
            j = j-1
            count += 1 # Counting
        if j >= 0: count += 1  # Counting
        a[j + 1] = element
        print(a)
    return count

def selectionSort(a):
    count = 0 # Count comparisons
    la = len(a)
    for i in range(0,la-1):
        minPos = i
        for j in range(i+1,la):
            if a[j] < a[minPos]:
                minPos = j
            count += 1 # Counting
        a[i],a[minPos] = a[minPos],a[i] # Tausche
        print(a)
    return count


def mergeSortFrame(a):

    def merge(a,p,l,l1):
        '''
        Merged zwei sortierte Teilfolgen zu einer sortierten (Teil-)Folge.
        Die sortierten Teilfolgen zu Beginn sind
          a[p:p+l1] und  a[p+l1:p+l], die Ergebnisfolge
        Vorsicht, l und l1 sind nicht ganz so intuitiv positioniert in
        der Parameterliste.
        '''
        count = 0 # Count comparisons
        # print("Calling merge(",a,",%d,%d,%d)" % (p,l,l1))
        b = []
        p1 = p        # p1 ist die aktuelle Position im linken Array-Teil
        p2 = p + l1   # p2 ist ist die aktuelle Position im rechten Array-Teil

        for i in range(l):
          if p1 < p + l1 and not p2 >= p + l: count += 1 # Count
          if p1 < p + l1 and (p2 >= p + l or a[p1] <= a[p2]):
              b.append(a[p1])
              p1 = p1+1
          else:
              b.append(a[p2])
              p2 = p2+1

        # geht netter: a[p:p+len(b)] = b
        for i in range(len(b)):
            a[p+i] = b[i]
        return count

    def mergeSort(a,p,l):
        count = 0 # Counting
        # print("Calling mergeSort(",a,",%d,%d)" % (p,l))
        if l > 1:
            l1 = l // 2
            count += mergeSort(a, p, l1)
            count += mergeSort(a, p+l1, l-l1)
            count += merge(a, p, l, l1)
            if DEBUG:
                print("Sorted [%d..%d]:" % (p,p+l-1),a)
            else:
                print(a)
        return count

    return mergeSort(a,0,len(a))

def quickSortFrame(a):
    def aufteilen(a,p,q):
        count = 0 # Counting
        l = p
        r = q
        m = (p+q) // 2

        while l < r:
            while a[l] < a[m]:
                l = l+1
                count += 1 # Counting
            count += 1 # Counting

            while a[r] > a[m]:
                r = r-1
                count += 1 # Counting
            count += 1 # Counting
            if l < r:
                a[r],a[l] = a[l],a[r]  # Vertauschen
                if DEBUG: print("Aufteilen von %d bis %d, tausche %d,%d (m=%d): " \
                          % (p,q,l,r,m),a,end='')
                else:
                    print(a)
                if l == m:
                    m = r
                    l = l+1
                elif r == m:
                    m = l
                    r = r-1
                else:
                    l = l+1
                    r = r-1
                if DEBUG: print(" => l=%d, r=%d, m=%d" % (l,r,m))
        if DEBUG: print("m,count: ",m,count)
        return m,count

    def quicksort(a, p, q):
        count = 0
        if p < q:
            m,count = aufteilen(a, p, q)
            count += quicksort(a, p, m-1)
            count += quicksort(a, m+1, q)
        return count

    return quicksort(a,0,len(a)-1)


def equals(a,b):
    la = len(a)
    lb = len(b)
    if not la == lb: return False
    for i in range(la):
        if not a[i] == b[i]: return False
    return True

in_list   = [[18,20,23,14,21,12,13,22]]
# in_list   = [[21,13,26,6,17,21,28],[37,4,24,13,56,97,49,13],[1,2,3,4,5,6],[6,5,4,3,2,1]]
in_sorted = [[12,13,14,18,20,21,22,23]]
# in_sorted = [[6,13,17,21,21,26,28],[4,13,13,24,37,49,56,97],[1,2,3,4,5,6],[1,2,3,4,5,6]]

sorts = [selectionSort]
# sorts = [insertionSort,selectionSort,mergeSortFrame,quickSortFrame]

for i in range(len(in_list)):
    a = in_list[i]
    a_sorted = in_sorted[i]
    print("SORTIERE A=",a,":")
    for sort in sorts:
        b = a[:]  # Make a copy of a
        print("Executing ", sort.__name__)
        # print("Vor dem Sortieren: ",b)
        print(b)
        count = sort(b)
        print("(Vergleiche: %d) -- korrekt? " \
            % count,equals(a_sorted,b),"\n")
    print ('-'*50,"\n")