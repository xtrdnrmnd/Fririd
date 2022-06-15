# Data Mining
import csv
import sys
# WEIGHTS of the modules
STATUS = 5
VISA = 2
SAFETY = 2
PRICE = 1

# MAX def of the variables
# Status: closed, partially open, open
SMAX = 3
# Safety: very safe, safe, not safe, dangerous
BMAX = 10
# Price: very cheap, cheap, medium, expensive, very expensive - overall 10 (2 for each category)
PMAX = 10
# Visa: no, visa on Arrival, eVisa, visa required
VMAX = 4


# Function to calculate the status
def status(toC):
    with open('./data/status.csv', 'r') as f:
        mycsv = csv.reader(f)
        status = ""
        for row in mycsv:
            if row[0] == toC:
                status = row[1]
    if status == "Open":
        return 3
    elif status == "Closed":
        return 1
    else:
        return 2

# Function to calculate the safety


def safety(toC):
    with open('./data/crimeIndex.csv', 'r') as f:
        mycsv = csv.reader(f)
        rate = ""
        maxCrRate = 0.0
        for row in mycsv:
            if row[1] == toC:
                rate = row[2]
            if row[2] != "crimeIndex":
                if (float(row[2]) > maxCrRate):
                    maxCrRate = float(row[2])
    crimeDevider = maxCrRate / 5

    with open('./data/earthquakes.csv', 'r') as f2:
        mycsv2 = csv.reader(f2)
        numQ = 0
        for row in mycsv2:
            if toC in row[2]:
                numQ += 1
    # print(numQ)
    final = 0
    if float(rate) >= crimeDevider * 4:
       # print("1 "+rate)
        final += 1
    elif float(rate) < crimeDevider * 4 and float(rate) >= crimeDevider * 3:
        #print("2 "+rate)
        final += 2
    elif float(rate) < crimeDevider * 3 and float(rate) >= crimeDevider * 2:
        #print("3 "+rate)
        final += 3
    elif float(rate) < crimeDevider * 2 and float(rate) >= crimeDevider:
        #print("4 "+rate)
        final += 4
    else:
       # print("5 "+rate)
        final += 5

    if (numQ > 7):
        final += 1
    elif numQ < 8 and numQ >= 6:
        final += 2
    elif numQ < 6 and numQ >= 4:
        final += 3
    elif numQ < 4 and numQ >= 2:
        final += 4
    else:
        final += 5

    return (final)


# Function to get the visa information


def visa(fromC, toC):
    with open('./data/visa.csv', 'r') as f:
        mycsv = csv.reader(f)
        cStatus = ""
        for row in mycsv:
            if row[0][0] == fromC[0] and row[0][1] == fromC[1] and row[0][2] == fromC[2] and row[0][3] == fromC[3]:
                if toC in row[1].replace(" ", ""):
                    cStatus = row[2]

        # print(cStatus)
    if (cStatus == "Visa not required"):
        # print(4)
        return 4
    elif (cStatus == "Visa on arrival"):
        # print(3)
        return 3
    elif (cStatus == "Visa required"):
        # print(1)
        return 1
    else:
        # print(2)
        return 2


def expenses(fromC, toC):
    # Finding average salary and average salary of "from" Country
    with open('./data/Salary_avg.csv', 'r') as f:
        mycsv = csv.reader(f)
        salaryFrom = ""
        salaryTo = ""
        for row in mycsv:
            if row[0] == fromC:
                salaryFrom += row[1]
            if row[0] == toC:
                salaryTo += row[1]

    with open('./data/csvData.csv', 'r') as f2:
        mycsv2 = csv.reader(f2)
        costFrom = ""
        costTo = ""
        for row in mycsv2:
            if row[1] == fromC:
                costFrom += row[2]
            if row[1] == toC:
                costTo += row[2]

    salaryTo = float(salaryTo.replace(",", ""))
    salaryFrom = float(salaryFrom.replace(",", ""))
    costTo = float(costTo)
    costFrom = float(costFrom)
    if (salaryFrom > salaryTo + 800):
        if (costFrom > costTo - 30):
          #  print("10 " + str(salaryTo) + " " + str(salaryFrom) +
           #       "    " + str(costFrom) + " " + str(costTo))
            return 10
        else:
           # print("9 " + str(salaryTo) + " " + str(salaryFrom) +
            #     "    " + str(costFrom) + " " + str(costTo))
            return 9
    elif (salaryFrom > salaryTo + 400 and salaryFrom <= salaryTo + 800):
        if (costFrom > costTo - 30):
          #  print("8 " + str(salaryTo) + " " + str(salaryFrom) +
            #      "    " + str(costFrom) + " " + str(costTo))
            return 8
        else:
           # print("7 " + str(salaryTo) + " " + str(salaryFrom) +
            #    "    " + str(costFrom) + " " + str(costTo))
            return 7
    elif (salaryFrom <= salaryTo + 400 and salaryFrom >= salaryTo - 400):
        if (costFrom > costTo - 30):
            # print("6 " + str(salaryTo) + " " + str(salaryFrom) +
            #      "    " + str(costFrom) + " " + str(costTo))
            return 6
        else:
           # print("5 " + str(salaryTo) + " " + str(salaryFrom) +
            #      "    " + str(costFrom) + " " + str(costTo))
            return 5
    elif (salaryFrom < salaryTo - 400 and salaryFrom >= salaryTo - 800):
        if (costFrom > costTo - 30):
           # print("4 " + str(salaryTo) + " " + str(salaryFrom) +
            #      "    " + str(costFrom) + " " + str(costTo))
            return 4
        else:
           # print("3 " + str(salaryTo) + " " + str(salaryFrom) +
            #      "    " + str(costFrom) + " " + str(costTo))
            return 3
    else:  # salaryto < salaryfrom - 800
        if (costFrom > costTo - 30):
            # print("2 " + str(salaryTo) + " " + str(salaryFrom) +
            #     "    " + str(costFrom) + " " + str(costTo))
            return 2
        else:
            # print("1 " + str(salaryTo) + " " + str(salaryFrom) +
            # "    " + str(costFrom) + " " + str(costTo))
            return 1


# Algorithm to calculate the rating
def count(S, V, B, P):
    R = S * STATUS / SMAX + V * VISA / VMAX + B * SAFETY / BMAX + PRICE / PMAX
    return R


def main(fromC, toC):
    res = []
    res.append([count(3, visa(fromC, toC), 9, 9),
                status(toC), visa(fromC, toC)])
    return count(status(toC), visa(fromC, toC), safety(toC), expenses(fromC, toC))


print(main(sys.argv[1], sys.argv[2]))
